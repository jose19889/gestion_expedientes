<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Expediente <?= esc($dossier['codigo']) ?></title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0 30px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4e73df;
            padding-bottom: 10px;
        }

        .logo {
            width: 150px;
            height: 60px;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #999;
            font-size: 14px;
        }

        .qr {
            width: 100px;
            height: 100px;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        p {
            margin: 2px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }

        .estado-section {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <!-- Logo -->
    <div class="logo">
        LOGO EMPRESA
    </div>

    <!-- Datos expediente -->
    <div>
        <strong>Expediente:</strong> <?= esc($dossier['codigo']) ?><br>
        <strong>Fecha:</strong> <?= date('Y-m-d') ?>
    </div>

    <!-- QR -->
    <?php if(!empty($dossier['codigo_qr'])): ?>
        <div>
            <img class="qr" src="<?= base_url($dossier['codigo_qr']) ?>">
        </div>
    <?php endif; ?>
</header>

<h2><?= esc($dossier['titulo']) ?></h2>
<p><strong>Descripción:</strong> <?= nl2br(esc($dossier['descripcion'])) ?></p>
<p><strong>Departamento:</strong> <?= esc($dossier['departamento_actual']) ?></p>

<?php if(!empty($archivos)): ?>
    <h3>Archivos adjuntos por estado</h3>
    <?php
    // Agrupar archivos por estado
    $archivosPorEstado = [];
    foreach ($archivos as $file) {
        $estado = $file['estado_nombre'] ?? 'Sin estado';
        $archivosPorEstado[$estado][] = $file;
    }
    ?>

    <?php foreach ($archivosPorEstado as $estado => $filesEstado): ?>
        <div class="estado-section">
            <h4>Estado: <?= esc($estado) ?></h4>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($filesEstado as $i => $file): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($file['nombre_original']) ?></td>
                            <td><?= esc($file['tipo'] ?: '-') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>