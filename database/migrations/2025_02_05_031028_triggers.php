<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Crear la función de validación de cédula
        DB::unprepared('
            CREATE OR REPLACE FUNCTION validar_cedula() RETURNS TRIGGER AS $$
            BEGIN
                -- Aseguramos que la cédula tenga 10 dígitos y solo números
                IF length(NEW.cedula) != 10 OR NEW.cedula !~ \'^\d+$\' THEN
                    RAISE EXCEPTION \'La cédula debe tener exactamente 10 dígitos numéricos\';
                END IF;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ');



        // Crear el trigger que ejecuta la función de validación de cédula
        DB::unprepared('
            CREATE TRIGGER trigger_validar_cedula
            BEFORE INSERT OR UPDATE ON clientes
            FOR EACH ROW EXECUTE FUNCTION validar_cedula();
        ');

        // Crear la función para validar stock antes de insertar o actualizar un detalle de venta
        DB::unprepared('
            CREATE OR REPLACE FUNCTION validar_stock_before_update() RETURNS TRIGGER AS $$
            BEGIN
                -- Verificar si la cantidad a vender (sumada con el valor actual) excede el stock disponible
                IF NEW.cantidad > (SELECT cantidad_stock FROM productos WHERE id = NEW.producto_id) THEN
                    RAISE EXCEPTION \'La cantidad seleccionada excede el stock disponible\';
                END IF;
                -- Si todo es correcto, permitir la operación
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ');

        // Crear el trigger que valida el stock antes de insertar o actualizar un detalle de venta
        DB::unprepared('
            CREATE TRIGGER trigger_validar_stock_before_update
            BEFORE INSERT OR UPDATE ON detalle_venta
            FOR EACH ROW
            EXECUTE FUNCTION validar_stock_before_update();
        ');

        // Crear la función para actualizar el stock después de insertar o actualizar un detalle de venta
        DB::unprepared('
            CREATE OR REPLACE FUNCTION actualizar_stock_after_update() RETURNS TRIGGER AS $$
            BEGIN
                -- Restar la cantidad vendida del stock
                UPDATE productos
                SET cantidad_stock = cantidad_stock - NEW.cantidad
                WHERE id = NEW.producto_id;
                
                -- Asegurarse de que el stock no quede negativo
                IF (SELECT cantidad_stock FROM productos WHERE id = NEW.producto_id) < 0 THEN
                    RAISE EXCEPTION \'No hay suficiente stock para esta venta\';
                END IF;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ');

        // Crear el trigger que actualiza el stock después de insertar o actualizar un detalle de venta
        DB::unprepared('
            CREATE TRIGGER trigger_actualizar_stock_after_update
            AFTER INSERT OR UPDATE ON detalle_venta
            FOR EACH ROW
            EXECUTE FUNCTION actualizar_stock_after_update();
        ');

        // Funcion para validar el año de fabricacion de un producto
        DB::unprepared('
        CREATE OR REPLACE FUNCTION validar_año_fabricacion() RETURNS TRIGGER AS $$
        BEGIN
            -- Verificar si el año de fabricación es mayor al año actual
            IF NEW.año_fabricacion > EXTRACT(YEAR FROM CURRENT_DATE) THEN
                RAISE EXCEPTION \'El año de fabricación no puede ser mayor al año actual\';
            END IF;
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;
    ');

    // Crear el trigger que valida el año de fabricación antes de insertar o actualizar un producto
    DB::unprepared('
        CREATE TRIGGER trigger_validar_año_fabricacion
        BEFORE INSERT OR UPDATE ON productos
        FOR EACH ROW
        EXECUTE FUNCTION validar_año_fabricacion();
    ');

    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar los triggers y funciones creados
        DB::unprepared('DROP TRIGGER IF EXISTS trigger_validar_cedula ON clientes');
        DB::unprepared('DROP TRIGGER IF EXISTS trigger_validar_stock_before_update ON detalle_venta');
        DB::unprepared('DROP TRIGGER IF EXISTS trigger_actualizar_stock_after_update ON detalle_venta');

        DB::unprepared('DROP FUNCTION IF EXISTS validar_cedula');
        DB::unprepared('DROP FUNCTION IF EXISTS validar_stock_before_update');
        DB::unprepared('DROP FUNCTION IF EXISTS actualizar_stock_after_update');


        DB::unprepared('DROP TRIGGER IF EXISTS trigger_validar_año_fabricacion ON productos');
        DB::unprepared('DROP FUNCTION IF EXISTS validar_año_fabricacion');
    }
};
