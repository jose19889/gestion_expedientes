<?php

namespace App\Controllers;
use App\Models\FileModel;

class FileController extends BaseController
{
    protected $FileModel;

    public function __construct()
    {
        $this->FileModel = new FileModel();
    }

  
public function display_file($id)
{
    // Carga tu modelo de archivos (ajusta el nombre según tu proyecto)
    $model = new \App\Models\FileModel(); 
    $archivoEnBD = $model->find($id);

    if (!$archivoEnBD) {
        return $this->response->setStatusCode(404, 'Archivo no encontrado en BD');
    }

    // Según tu captura de BD, la columna se llama 'ruta_archivo'
    // Ejemplo: "writable/uploads/expedientes/1772722140_20401af034...pdf"
    
    // Como la ruta en BD ya incluye 'writable/', usamos ROOTPATH
    $rutaAbsoluta = ROOTPATH . $archivoEnBD['ruta_archivo'];

    if (file_exists($rutaAbsoluta)) {
        if (ob_get_level()) ob_end_clean();
        
        $mime = mime_content_type($rutaAbsoluta);
        
        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setHeader('Content-Disposition', 'inline; filename="' . $archivoEnBD['nombre_original'] . '"')
            ->setBody(file_get_contents($rutaAbsoluta));
    } else {
        return $this->response->setStatusCode(404, "El archivo físico no existe en: " . $rutaAbsoluta);
    }
}


   
}