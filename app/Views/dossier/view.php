<?= $this->include('app/header') ?>
<?= $this->section('content') ?>

<section class="content">
  <div class="container">

    <div class="card">
         <br><br>
      <div class="card-header">
        <h3 class="card-title">Detalles del Expediente</h3>
      </div>

      <div class="card-body">
       <?= $this->include('app/alerts') ?>
       
        </div>
       
<div class="timeline shadow-sm p-4 bg-white rounded">
    <?php if (!empty($movimientos)): ?>
        <?php foreach ($movimientos as $row): ?>
            <div class="timeline-item border-left ps-4 pb-4 position-relative" style="border-left: 3px solid #007bff;">
                <span class="position-absolute" style="left: -9px; top: 0; width: 15px; height: 15px; background: #007bff; border-radius: 50%;"></span>
                
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 text-primary fw-bold">
                        <i class="fas fa-tag"></i> Estado: <?= $row->estado_nombre; ?>
                    </h6>
                    <small class="text-muted">
                        <i class="far fa-clock"></i> <?= date('d/m/Y H:i', strtotime($row->fecha ?? $row->created_at)); ?>
                    </small>
                </div>

                <div class="bg-light p-3 rounded border">
                    <p class="mb-1">
                        <strong><i class="fas fa-sign-out-alt text-danger"></i> Origen:</strong> <?= $row->dep_origen; ?> <br>
                        <strong><i class="fas fa-sign-in-alt text-success"></i> Destino:</strong> <?= $row->dep_destino; ?>
                    </p>
                    
                    <p class="small text-secondary mb-2">
                        <i class="fas fa-user-edit"></i> <b>Responsable:</b> <?= $row->usuario_nombre; ?>
                    </p>

                    <?php if (!empty($row->observaciones)): ?>
                        <div class="alert alert-warning py-1 px-2 mb-0 mt-2 italic" style="font-size: 0.9rem;">
                            <i class="fas fa-comment-dots"></i> "<?= $row->observaciones; ?>"
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="alert alert-info">
            No hay registros de movimientos para este expediente.
        </div>
    <?php endif; ?>
</div>
      </div>
    </div>

  </div>
</section>

<script>
const inputFiles = document.getElementById('expedientes');
const listaArchivos = document.getElementById('lista-archivos');
let archivosSeleccionados = [];

inputFiles.addEventListener('change', (e) => {
    const nuevos = Array.from(e.target.files);
    archivosSeleccionados = archivosSeleccionados.concat(nuevos);
    renderLista();
    inputFiles.value = '';
});

function renderLista() {
    listaArchivos.innerHTML = '';
    archivosSeleccionados.forEach((file, index) => {
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        li.textContent = file.name;

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn btn-sm btn-danger';
        btn.textContent = 'Eliminar';
        btn.addEventListener('click', () => {
            archivosSeleccionados.splice(index, 1);
            renderLista();
        });

        li.appendChild(btn);
        listaArchivos.appendChild(li);
    });
}

document.querySelector('form').addEventListener('submit', () => {
    if (archivosSeleccionados.length > 0) {
        const dataTransfer = new DataTransfer();
        archivosSeleccionados.forEach(f => dataTransfer.items.add(f));
        inputFiles.files = dataTransfer.files;
    }
});
</script>
<style>
    
</style>
<?= $this->include('app/footer') ?>