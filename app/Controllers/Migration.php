<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Migration extends BaseController
{

protected $backupPath;

public function __construct()
{
    helper(['filesystem','file']);

    $this->backupPath = WRITEPATH.'backups/';

    if(!is_dir($this->backupPath)){
        mkdir($this->backupPath,0777,true);
    }
}


/*
|--------------------------------------------------------------------------
| PANEL PRINCIPAL
|--------------------------------------------------------------------------
*/

public function index()
{
    $map = directory_map($this->backupPath);

    $data['backups'] = $map ? $map : [];

    return view('migration/backup_list',$data);
}



/*
|--------------------------------------------------------------------------
| BACKUP BASE DE DATOS
|--------------------------------------------------------------------------
*/

public function backupDB()
{

    set_time_limit(0);

    $db = \Config\Database::connect();

    $tables = $db->listTables();

    $sql = "-- BACKUP BD\n";
    $sql .= "-- Fecha ".date('Y-m-d H:i:s')."\n\n";

    foreach ($tables as $table){

        $create = $db->query("SHOW CREATE TABLE `$table`")->getRowArray();

        $sql .= "DROP TABLE IF EXISTS `$table`;\n";
        $sql .= $create['Create Table'].";\n\n";

        $rows = $db->table($table)->get()->getResultArray();

        foreach($rows as $row){

            $keys = array_map(fn($k)=>"`$k`",array_keys($row));

            $values = array_map(function($v) use ($db){
                return $v === null ? "NULL" : $db->escape($v);
            },array_values($row));

            $sql .= "INSERT INTO `$table` (".implode(",",$keys).") VALUES (".implode(",",$values).");\n";
        }

        $sql .= "\n";
    }

    $file = $this->backupPath."backup_db_".date('Ymd_His').".sql";

    write_file($file,$sql);

    $zip = new \ZipArchive();

    $zipFile = $file.".zip";

    if($zip->open($zipFile,\ZipArchive::CREATE) === TRUE){

        $zip->addFile($file,basename($file));

        $zip->close();

        unlink($file);

        return $this->response->download($zipFile,null);
    }

}



/*
|--------------------------------------------------------------------------
| BACKUP ARCHIVOS DEL PROYECTO
|--------------------------------------------------------------------------
*/

public function backupFiles()
{
    set_time_limit(0);

    $root = realpath(ROOTPATH);

    $zipName = $this->backupPath . "backup_project_" . date('Ymd_His') . ".zip";

    $zip = new \ZipArchive();

    if ($zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
        die("No se pudo crear el ZIP");
    }

    $files = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($root, \RecursiveDirectoryIterator::SKIP_DOTS),
        \RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $file) {

        if (!$file->isDir()) {

            $path = $file->getRealPath();

            // excluir carpeta de backups
            if (strpos($path, 'writable\\backups') !== false) {
                continue;
            }

            // excluir vendor (opcional)
            if (strpos($path, 'vendor') !== false) {
                continue;
            }

            $relativePath = substr($path, strlen($root) + 1);

            $zip->addFile($path, $relativePath);
        }
    }

    $zip->close();

    if (!file_exists($zipName)) {
        die("Error creando el ZIP");
    }

    return $this->response->download($zipName, null);
}


/*
|--------------------------------------------------------------------------
| DESCARGAR BACKUP
|--------------------------------------------------------------------------
*/

public function download($file)
{

    $filePath = $this->backupPath.$file;

    if(!file_exists($filePath)){
        return redirect()->back();
    }

    return $this->response->download($filePath,null);
}



/*
|--------------------------------------------------------------------------
| RESTAURAR (pendiente)
|--------------------------------------------------------------------------
*/

public function restore()
{
    return "Función de restauración aún no implementada";
}


public function delete($file)
{

    $filePath = $this->backupPath . $file;

    if(file_exists($filePath)){

        unlink($filePath);

        return redirect()->to('/backup')
        ->with('success','Backup eliminado correctamente');

    }

    return redirect()->to('/backup')
    ->with('error','Archivo no encontrado');

}


public function backupAll()
{
    set_time_limit(0);

    $root = realpath(ROOTPATH);

    $zipName = WRITEPATH . "backups/backup_full_" . date('Ymd_His') . ".zip";

    if(!is_dir(WRITEPATH."backups")){
        mkdir(WRITEPATH."backups",0777,true);
    }

    $zip = new \ZipArchive();

    if ($zip->open($zipName, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
        die("No se pudo crear el ZIP");
    }

    /*
    ============================
    1️⃣ GENERAR BACKUP SQL
    ============================
    */

    $db = \Config\Database::connect();
    $tables = $db->listTables();

    $sql = "";

    foreach ($tables as $table) {

        $create = $db->query("SHOW CREATE TABLE `$table`")->getRowArray();

        $sql .= $create['Create Table'].";\n\n";

        $rows = $db->table($table)->get()->getResultArray();

        foreach ($rows as $row) {

            $values = array_map(function($v) use ($db){
                return $v === null ? "NULL" : $db->escape($v);
            }, array_values($row));

            $sql .= "INSERT INTO `$table` VALUES(".implode(",",$values).");\n";
        }

        $sql .= "\n\n";
    }

    $zip->addFromString("database.sql", $sql);


    /*
    ============================
    2️⃣ BACKUP ARCHIVOS
    ============================
    */

    $files = new \RecursiveIteratorIterator(
        new \RecursiveDirectoryIterator($root,\RecursiveDirectoryIterator::SKIP_DOTS),
        \RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files as $file) {

        if (!$file->isDir()) {

            $path = $file->getRealPath();

            // evitar meter backups dentro del backup
            if(strpos($path,"writable\\backups") !== false){
                continue;
            }

            $relative = substr($path, strlen($root) + 1);

            $zip->addFile($path, $relative);
        }
    }

    $zip->close();

    return $this->response->download($zipName,null);
}

}