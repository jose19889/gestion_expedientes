<?= $this->include('app/header') ?>
<?= $this->section('content') ?>

<section class="content">
  <div class="container">

    <div class="card">
         <br><br>
      <div class="card-header">
        <h3 class="card-title">Editar Expediente</h3>
      </div>

      <div class="card-body">
       <?= $this->include('app/alerts') ?>
       
        </div>
       

<form action="<?= site_url('dossier-update/'.$dossier->id) ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

    <div class="row g-3">

        <!-- Código -->
        <div class="col-md-4">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" name="codigo" id="codigo" class="form-control" value="<?= esc($dossier->codigo) ?>" readonly>
        </div>

        <!-- Título -->
        <div class="col-md-4">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="<?= esc($dossier->titulo) ?>" required>
        </div>

        
        <!-- Estado -->
        <div class="col-md-4">
            <label for="estado_id" class="form-label">Estado</label>
            <select name="estado_id" id="estado_id" class="form-select" required>
                <option value="">Seleccione</option>
                <?php foreach($estados as $est): ?>
                    <option value="<?= $est->id ?>" <?= ($dossier->estado_id == $est->id) ? 'selected' : '' ?>>
                        <?= esc($est->nombre) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Descripción (ocupando 8 columnas) -->
        <div class="col-md-8">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required><?= esc($dossier->descripcion) ?></textarea>
        </div>

        <!-- Archivos adjuntos -->
       <!-- Archivos adjuntos -->
<div class="col-12 mb-3">
    <label for="expedientes" class="form-label">Adjuntar archivos</label>
    <input type="file" name="expedientes[]" id="expedientes" multiple class="form-control">
    <small class="form-text text-muted">Puedes seleccionar varios archivos PDF al mismo tiempo.</small>

    <ul id="lista-archivos" class="list-group mt-2">
    <?php if(!empty($archivos)): ?>
        <?php foreach($archivos as $archivo): ?>
            <li class="list-group-item mb-2 d-flex justify-content-between align-items-center">
                <span class="text-truncate" style="max-width: 60%;"><?= esc($archivo['nombre_original']) ?></span>
                
                <div class="btn-group">
                    <a href="<?= site_url('file-display/'.$archivo['id']) ?>" 
                       target="_blank" 
                       class="btn btn-sm btn-info">
                       <i class="fas fa-eye"></i> Ver
                    </a>
                    
                    <a href="<?= site_url('file-display/'.$archivo['id']) ?>?download=1" 
                       download="<?= esc($archivo['nombre_original']) ?>"
                       class="btn btn-sm btn-success">
                       <i class="fas fa-download"></i> Descargar
                    </a>
                </div>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li class="list-group-item text-muted">No hay archivos adjuntos.</li>
    <?php endif; ?>
    </ul>
</div>
</div>
    </div>

    <!-- Botones -->
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Actualizar Expediente</button>
        <a href="<?= site_url('expedientes'); ?>" class="btn btn-secondary">Cancelar</a>
    </div>

</form>
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

<?= $this->include('app/footer') ?>