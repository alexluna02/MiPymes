<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:backup-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Realiza un respaldo de la base de datos PostgreSQL';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Obtener las credenciales de la base de datos desde el archivo .env
        $dbHost = env('DB_HOST');
        $dbPort = env('DB_PORT');
        $dbName = env('DB_DATABASE');
        $dbUser = env('DB_USERNAME');
        $dbPassword = env('DB_PASSWORD');
        
        // Ruta donde se guardará el respaldo (actualizado a la carpeta deseada)
        $backupPath = '/home/alex/BDD/';

        // Crea la carpeta si no existe
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0777, true);
        }

        // El nombre del archivo de respaldo con fecha y hora
        $fileName = 'backup_' . date('Y_m_d_H_i_s') . '.sql';
        $backupFile = $backupPath . $fileName;

        // Comando para realizar el respaldo usando pg_dump
        $command = "PGPASSWORD={$dbPassword} pg_dump --host={$dbHost} --port={$dbPort} --username={$dbUser} --no-password --format=c --file={$backupFile} {$dbName}";

        // Ejecutar el comando
        $exitCode = null;
        $output = null;
        exec($command, $output, $exitCode);

        if ($exitCode === 0) {
            $this->info("Respaldo realizado exitosamente en: {$backupFile}");
        } else {
            $this->error("Hubo un error al hacer el respaldo.");
        }
    }
}
