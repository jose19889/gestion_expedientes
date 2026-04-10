<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        /* Configuraciones críticas para Dompdf */
        @page { margin: 1cm; }
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 11pt; 
            line-height: 1.3;
            color: #333;
        }

        /* Layout con tablas (Único método 100% fiable en Dompdf) */
        .tabla-cabecera {
            width: 100%;
            border-bottom: 2px solid #4e73df;
            margin-bottom: 20px;
        }
        .tabla-cabecera td {
            vertical-align: middle;
            padding-bottom: 10px;
        }

        .seccion-titulo {
            background-color: #f8f9fc;
            padding: 10px;
            border-left: 5px solid #4e73df;
            margin-bottom: 20px;
        }

        .datos-tabla {
            width: 100%;
            border-collapse: collapse;
        }
        .datos-tabla td {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .label {
            font-weight: bold;
            width: 30%;
            color: #555;
        }

        /* Estilo para la lista de archivos */
        .tabla-archivos {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .tabla-archivos th {
            background-color: #4e73df;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 10pt;
        }
        .tabla-archivos td {
            padding: 8px;
            border: 1px solid #e3e6f0;
            font-size: 10pt;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8pt;
            color: #999;
            padding-top: 5px;
            border-top: 1px solid #eee;
        }
    </style>
</head>
<body>

    <table class="tabla-cabecera">
        <tr>
            <td style="width: 50%;">
                <h1 style="margin:0; color: #4e73df;">LOGO EMPRESA</h1>
                <p style="margin:5px 0; font-size: 10pt;">
                    <strong>Expediente:</strong> <?= esc($dossier->codigo) ?><br>
                    <strong>Fecha Emisión:</strong> <?= date('d/m/Y') ?>
                </p>
            </td>
            <td style="width: 50%; text-align: right;">
                <?php if (!empty($qrBase64)): ?>
                    <img src="<?= $qrBase64 ?>" width="120" height="120" style="border: none;">
                <?php else: ?>
                    <div style="color: red; border: 1px solid red; padding: 5px; font-size: 9pt;">
                        QR NO DISPONIBLE
                    </div>
                <?php endif; ?>
            </td>
        </tr>
    </table>

    <div class="seccion-titulo">
        <h2 style="margin:0; text-transform: uppercase;"><?= esc($dossier->titulo) ?></h2>
    </div>

    <table class="datos-tabla">
        <tr>
            <td class="label">Departamento:</td>
            <td><?= esc($departamentoNombre ?: 'General') ?></td>
        </tr>
        <tr>
            <td class="label">Prioridad:</td>
            <td><?= esc($dossier->prioridad ?: 'Normal') ?></td>
        </tr>
        <tr>
            <td class="label">Descripción:</td>
            <td><?= nl2br(esc($dossier->descripcion)) ?></td>
        </tr>
    </table>

    <?php if (!empty($archivos)): ?>
        <h3 style="margin-top: 30px; color: #4e73df;">Documentos Adjuntos</h3>
        <table class="tabla-archivos">
            <thead>
                <tr>
                    <th>Nombre del Archivo</th>
                    <th>Fecha de Carga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($archivos as $archivo): ?>
                    <tr>
                        <td><?= esc($archivo['nombre_original']) ?></td>
                        <td><?= date('d/m/Y', strtotime($archivo['fecha_creacion'] ?? date('Y-m-d'))) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div class="footer">
        Documento generado automáticamente por el Sistema de Gestión de Expedientes.
        <br>ID de Validación: <?= esc($dossier->hash_publico ?? 'N/A') ?>
    </div>

</body>
</html>