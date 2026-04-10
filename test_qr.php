<?php
// Carga el autoloader de Composer
require 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// 1. Prueba de lectura de archivo (CAMBIA EL NOMBRE POR UNO QUE TENGAS)
$nombreQR = 'exp_17.png'; 
$path = 'writable/uploads/qrs/' . $nombreQR;

if (!file_exists($path)) {
    die("ERROR: El archivo no existe en $path");
}

$data = file_get_contents($path);
$base64 = 'data:image/png;base64,' . base64_encode($data);

echo "Archivo leído correctamente. Generando PDF de prueba...\n";

// 2. Configuración de Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);
// HTML ultra simple para descartar errores de CSS
$html = "<html><body><h1>Test QR</h1><img src='$base64' width='100' height='100'></body></html>";

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// 3. Guardar el PDF en la raíz para que lo revises
file_put_contents('resultado_test.pdf', $dompdf->output());
echo "PDF generado como 'resultado_test.pdf'. Ábrelo y mira si sale la X.\n";