<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class BackupController extends Controller
{
    
    public function generarCopia()
    {
        // Define el nombre del archivo de la copia de seguridad
        $backupFile = 'backups/' . 'backup_' . now()->format('Y_m_d_H_i_s') . '.sql';

        // Comando para hacer el volcado de la base de datos
        $databaseName = env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');
        
        // Comando de mysqldump
        $command = "mysqldump --user=$username --password=$password --host=$host $databaseName > " . base_path($backupFile);
        
        // Ejecuta el comando
        exec($command, $output, $return_var);
        
        // Verifica si el comando fue exitoso
        if ($return_var === 0) {
            return response()->download(base_path($backupFile));
        } else {
            return back()->with('error', 'Hubo un error al generar la copia de seguridad.');
        }
    }
    // Mostrar el formulario de carga académica
    public function form()
    {
        // Devuelve la vista con el formulario de carga académica
        return view('admin.copia_seguridad');
    }
    
    
}
