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
    public function up()
    {
        //Triggers users:insert,update,delete
        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_user_insert() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'insert', CONCAT('Inserted user with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_insert_user
        BEFORE INSERT ON users
        FOR EACH ROW
        EXECUTE FUNCTION log_user_insert();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_user_update() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'update', CONCAT('Updated user with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_update_user
        BEFORE UPDATE ON users
        FOR EACH ROW
        EXECUTE FUNCTION log_user_update();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_user_delete() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'delete', CONCAT('Deleted user with ID: ', OLD.id), NOW(), NOW());
            RETURN OLD;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_delete_user
        BEFORE DELETE ON users
        FOR EACH ROW
        EXECUTE FUNCTION log_user_delete();
    ");

        // Triggers productos:insert,update,delete
        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_product_insert() RETURNS TRIGGER AS $$
        --DECLARE
            --user_id integer;
        BEGIN
            --select id into user_id
            --from users
            --where name=current_user;

            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'insert', CONCAT('Inserted product with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_insert_product
        AFTER INSERT ON productos
        FOR EACH ROW
        EXECUTE FUNCTION log_product_insert();
    ");

        DB::unprepared("
    CREATE OR REPLACE FUNCTION log_product_update() RETURNS TRIGGER AS $$
    BEGIN
        INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
        VALUES (current_user, 'update', CONCAT('Updated product with ID: ', NEW.id), NOW(), NOW());
        RETURN NEW;
    END;
    $$ LANGUAGE plpgsql;

    CREATE TRIGGER before_update_product
    BEFORE UPDATE ON productos
    FOR EACH ROW
    EXECUTE FUNCTION log_product_update();
");

        DB::unprepared("
    CREATE OR REPLACE FUNCTION log_product_delete() RETURNS TRIGGER AS $$
    BEGIN
        INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
        VALUES (current_user, 'delete', CONCAT('Deleted product with ID: ', OLD.id), NOW(), NOW());
        RETURN OLD;
    END;
    $$ LANGUAGE plpgsql;

    CREATE TRIGGER before_delete_product
    BEFORE DELETE ON productos
    FOR EACH ROW
    EXECUTE FUNCTION log_product_delete();
");
        // Triggers clientes:insert,update,delete
        DB::unprepared("
CREATE OR REPLACE FUNCTION log_client_insert() RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
    VALUES (current_user, 'insert', CONCAT('Inserted client with ID: ', NEW.id), NOW(), NOW());
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER before_insert_client
BEFORE INSERT ON clientes
FOR EACH ROW
EXECUTE FUNCTION log_client_insert();
");

        DB::unprepared("
CREATE OR REPLACE FUNCTION log_client_update() RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
    VALUES (current_user, 'update', CONCAT('Updated client with ID: ', NEW.id), NOW(), NOW());
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER before_update_client
BEFORE UPDATE ON clientes
FOR EACH ROW
EXECUTE FUNCTION log_client_update();
");

        DB::unprepared("
CREATE OR REPLACE FUNCTION log_client_delete() RETURNS TRIGGER AS $$
BEGIN
    INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
    VALUES (current_user, 'delete', CONCAT('Deleted client with ID: ', OLD.id), NOW(), NOW());
    RETURN OLD;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER before_delete_client
BEFORE DELETE ON clientes
FOR EACH ROW
EXECUTE FUNCTION log_client_delete();
");
        //Triggers detalle_venta:insert,update,delete
        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_detalle_venta_insert() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'insert', CONCAT('Inserted detalle_venta with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_insert_detalle_venta
        BEFORE INSERT ON detalle_venta
        FOR EACH ROW
        EXECUTE FUNCTION log_detalle_venta_insert();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_detalle_venta_update() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'update', CONCAT('Updated detalle_venta with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_update_detalle_venta
        BEFORE UPDATE ON detalle_venta
        FOR EACH ROW
        EXECUTE FUNCTION log_detalle_venta_update();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_detalle_venta_delete() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'delete', CONCAT('Deleted detalle_venta with ID: ', OLD.id), NOW(), NOW());
            RETURN OLD;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_delete_detalle_venta
        BEFORE DELETE ON detalle_venta
        FOR EACH ROW
        EXECUTE FUNCTION log_detalle_venta_delete();
    ");
        //Triggers mantenimiento_maquinaria:insert,update,delete
        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_mantenimiento_maquinaria_insert() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'insert', CONCAT('Inserted mantenimiento_maquinaria with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_insert_mantenimiento_maquinaria
        BEFORE INSERT ON mantenimiento_maquinaria
        FOR EACH ROW
        EXECUTE FUNCTION log_mantenimiento_maquinaria_insert();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_mantenimiento_maquinaria_update() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'update', CONCAT('Updated mantenimiento_maquinaria with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_update_mantenimiento_maquinaria
        BEFORE UPDATE ON mantenimiento_maquinaria
        FOR EACH ROW
        EXECUTE FUNCTION log_mantenimiento_maquinaria_update();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_mantenimiento_maquinaria_delete() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'delete', CONCAT('Deleted mantenimiento_maquinaria with ID: ', OLD.id), NOW(), NOW());
            RETURN OLD;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_delete_mantenimiento_maquinaria
        BEFORE DELETE ON mantenimiento_maquinaria
        FOR EACH ROW
        EXECUTE FUNCTION log_mantenimiento_maquinaria_delete();
    ");
        //Triggers metodo_pago:insert,update,delete
        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_metodo_pago_insert() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'insert', CONCAT('Inserted metodo_pago with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_insert_metodo_pago
        BEFORE INSERT ON metodo_pago
        FOR EACH ROW
        EXECUTE FUNCTION log_metodo_pago_insert();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_metodo_pago_update() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'update', CONCAT('Updated metodo_pago with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_update_metodo_pago
        BEFORE UPDATE ON metodo_pago
        FOR EACH ROW
        EXECUTE FUNCTION log_metodo_pago_update();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_metodo_pago_delete() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'delete', CONCAT('Deleted metodo_pago with ID: ', OLD.id), NOW(), NOW());
            RETURN OLD;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_delete_metodo_pago
        BEFORE DELETE ON metodo_pago
        FOR EACH ROW
        EXECUTE FUNCTION log_metodo_pago_delete();
    ");
        //Triggers parametros:insert,update,delete
        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_parametros_insert() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'insert', CONCAT('Inserted parametros with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_insert_parametros
        BEFORE INSERT ON parametros
        FOR EACH ROW
        EXECUTE FUNCTION log_parametros_insert();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_parametros_update() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'update', CONCAT('Updated parametros with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_update_parametros
        BEFORE UPDATE ON parametros
        FOR EACH ROW
        EXECUTE FUNCTION log_parametros_update();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_parametros_delete() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'delete', CONCAT('Deleted parametros with ID: ', OLD.id), NOW(), NOW());
            RETURN OLD;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_delete_parametros
        BEFORE DELETE ON parametros
        FOR EACH ROW
        EXECUTE FUNCTION log_parametros_delete();
    ");
        //Triggers proveedores:insert,update,delete
        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_proveedores_insert() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'insert', CONCAT('Inserted proveedor with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_insert_proveedores
        BEFORE INSERT ON proveedores
        FOR EACH ROW
        EXECUTE FUNCTION log_proveedores_insert();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_proveedores_update() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'update', CONCAT('Updated proveedor with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_update_proveedores
        BEFORE UPDATE ON proveedores
        FOR EACH ROW
        EXECUTE FUNCTION log_proveedores_update();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_proveedores_delete() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'delete', CONCAT('Deleted proveedor with ID: ', OLD.id), NOW(), NOW());
            RETURN OLD;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_delete_proveedores
        BEFORE DELETE ON proveedores
        FOR EACH ROW
        EXECUTE FUNCTION log_proveedores_delete();
    ");
        //Triggers ventas:insert,update,delete
        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_ventas_insert() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'insert', CONCAT('Inserted venta with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_insert_ventas
        BEFORE INSERT ON ventas
        FOR EACH ROW
        EXECUTE FUNCTION log_ventas_insert();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_ventas_update() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'update', CONCAT('Updated venta with ID: ', NEW.id), NOW(), NOW());
            RETURN NEW;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_update_ventas
        BEFORE UPDATE ON ventas
        FOR EACH ROW
        EXECUTE FUNCTION log_ventas_update();
    ");

        DB::unprepared("
        CREATE OR REPLACE FUNCTION log_ventas_delete() RETURNS TRIGGER AS $$
        BEGIN
            INSERT INTO activity_log (user_id, action, details, created_at, updated_at)
            VALUES (current_user, 'delete', CONCAT('Deleted venta with ID: ', OLD.id), NOW(), NOW());
            RETURN OLD;
        END;
        $$ LANGUAGE plpgsql;

        CREATE TRIGGER before_delete_ventas
        BEFORE DELETE ON ventas
        FOR EACH ROW
        EXECUTE FUNCTION log_ventas_delete();
    ");
    }

    public function down()
    {
        //users
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_user ON users');
        DB::unprepared('DROP FUNCTION IF EXISTS log_user_insert');

        DB::unprepared('DROP TRIGGER IF EXISTS before_update_user ON users');
        DB::unprepared('DROP FUNCTION IF EXISTS log_user_update');

        DB::unprepared('DROP TRIGGER IF EXISTS before_delete_user ON users');
        DB::unprepared('DROP FUNCTION IF EXISTS log_user_delete');

        //productos
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_product ON productos');
        DB::unprepared('DROP FUNCTION IF EXISTS log_product_insert');

        DB::unprepared('DROP TRIGGER IF EXISTS before_update_product ON productos');
        DB::unprepared('DROP FUNCTION IF EXISTS log_product_update');

        DB::unprepared('DROP TRIGGER IF EXISTS before_delete_product ON productos');
        DB::unprepared('DROP FUNCTION IF EXISTS log_product_delete');

        //clientes
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_client ON clientes');
        DB::unprepared('DROP FUNCTION IF EXISTS log_client_insert');

        DB::unprepared('DROP TRIGGER IF EXISTS before_update_client ON clientes');
        DB::unprepared('DROP FUNCTION IF EXISTS log_client_update');

        DB::unprepared('DROP TRIGGER IF EXISTS before_delete_client ON clientes');
        DB::unprepared('DROP FUNCTION IF EXISTS log_client_delete');

        //detalle_venta
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_detalle_venta ON detalle_venta');
        DB::unprepared('DROP FUNCTION IF EXISTS log_detalle_venta_insert');

        DB::unprepared('DROP TRIGGER IF EXISTS before_update_detalle_venta ON detalle_venta');
        DB::unprepared('DROP FUNCTION IF EXISTS log_detalle_venta_update');

        DB::unprepared('DROP TRIGGER IF EXISTS before_delete_detalle_venta ON detalle_venta');
        DB::unprepared('DROP FUNCTION IF EXISTS log_detalle_venta_delete');

        //mantenimiento_maquinaria
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_mantenimiento_maquinaria ON mantenimiento_maquinaria');
        DB::unprepared('DROP FUNCTION IF EXISTS log_mantenimiento_maquinaria_insert');

        DB::unprepared('DROP TRIGGER IF EXISTS before_update_mantenimiento_maquinaria ON mantenimiento_maquinaria');
        DB::unprepared('DROP FUNCTION IF EXISTS log_mantenimiento_maquinaria_update');

        DB::unprepared('DROP TRIGGER IF EXISTS before_delete_mantenimiento_maquinaria ON mantenimiento_maquinaria');
        DB::unprepared('DROP FUNCTION IF EXISTS log_mantenimiento_maquinaria_delete');

        //metodo_pago
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_metodo_pago ON metodo_pago');
        DB::unprepared('DROP FUNCTION IF EXISTS log_metodo_pago_insert');

        DB::unprepared('DROP TRIGGER IF EXISTS before_update_metodo_pago ON metodo_pago');
        DB::unprepared('DROP FUNCTION IF EXISTS log_metodo_pago_update');

        DB::unprepared('DROP TRIGGER IF EXISTS before_delete_metodo_pago ON metodo_pago');
        DB::unprepared('DROP FUNCTION IF EXISTS log_metodo_pago_delete');

        //parametros
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_parametros ON parametros');
        DB::unprepared('DROP FUNCTION IF EXISTS log_parametros_insert');

        DB::unprepared('DROP TRIGGER IF EXISTS before_update_parametros ON parametros');
        DB::unprepared('DROP FUNCTION IF EXISTS log_parametros_update');

        DB::unprepared('DROP TRIGGER IF EXISTS before_delete_parametros ON parametros');
        DB::unprepared('DROP FUNCTION IF EXISTS log_parametros_delete');

        //proveedores
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_proveedores ON proveedores');
        DB::unprepared('DROP FUNCTION IF EXISTS log_proveedores_insert');

        DB::unprepared('DROP TRIGGER IF EXISTS before_update_proveedores ON proveedores');
        DB::unprepared('DROP FUNCTION IF EXISTS log_proveedores_update');

        DB::unprepared('DROP TRIGGER IF EXISTS before_delete_proveedores ON proveedores');
        DB::unprepared('DROP FUNCTION IF EXISTS log_proveedores_delete');

        //ventas
        DB::unprepared('DROP TRIGGER IF EXISTS before_insert_ventas ON ventas');
        DB::unprepared('DROP FUNCTION IF EXISTS log_ventas_insert');

        DB::unprepared('DROP TRIGGER IF EXISTS before_update_ventas ON ventas');
        DB::unprepared('DROP FUNCTION IF EXISTS log_ventas_update');

        DB::unprepared('DROP TRIGGER IF EXISTS before_delete_ventas ON ventas');
        DB::unprepared('DROP FUNCTION IF EXISTS log_ventas_delete');
    }
};
