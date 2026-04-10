<!DOCTYPE html>
<html>
<head>
    <title>Backups del Sistema</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">

<h3>Gestión de Backups</h3>
<hr>

<!-- BOTONES -->
<button id="btnDB" class="btn btn-primary">Guardar Base de Datos</button>
<button id="btnFiles" class="btn btn-success">Guardar Archivos del Proyecto</button>
<button id="btnAll" class="btn btn-dark">
Backup TOTAL del sistema
</button>

<hr>

<!-- BARRA DE PROGRESO -->
<div class="progress mb-4">
    <div id="progressBar" class="progress-bar bg-info" style="width:0%">0%</div>
</div>

<h4>Backups existentes</h4>
<table class="table table-bordered">
    <thead>
        <tr><th>Archivo</th><th>Acción</th></tr>
    </thead>
    <tbody>
    <?php if(!empty($backups)): ?>
        <?php foreach($backups as $file): ?>
        <tr>
            <td><?= $file ?></td>
            <td>
                <a class="btn btn-info btn-sm" href="<?= site_url('migration/download/'.$file) ?>">Descargar</a>
                <form method="post" action="<?= site_url('migration/delete/'.$file) ?>" style="display:inline;">
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Eliminar este backup?')">Borrar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="2">No hay backups aún</td></tr>
    <?php endif; ?>
    </tbody>
</table>

</div>

<script>
function startBackup(url) {
    const progressBar = document.getElementById('progressBar');
    progressBar.style.width = '0%';
    progressBar.innerHTML = '0%';

    // AJAX con Fetch
    fetch(url, { method: 'POST' })
    .then(response => response.blob()) // Recibe archivo zip
    .then(blob => {
        // Simula progreso completo
        progressBar.style.width = '100%';
        progressBar.innerHTML = '100%';

        // Descargar automáticamente
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = url.includes('create-db') ? 'backup_db.zip' : 'backup_files.zip';
        link.click();
    })
    .catch(err => {
        alert('Error generando backup');
        console.error(err);
    });
}

// Asignar botones
document.getElementById('btnDB').addEventListener('click', () => {
    startBackup("<?= site_url('migration/create-db') ?>");
});

document.getElementById('btnFiles').addEventListener('click', () => {
    startBackup("<?= site_url('migration/create-files') ?>");
});

document.getElementById('btnAll').addEventListener('click', () => {
    startBackup("<?= site_url('migration/create-all') ?>");
});
</script>

</body>
</html>