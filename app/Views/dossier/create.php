<?= $this->include('app/header') ?>
<?= $this->section('content') ?>
< <!-- Main Sidebar Container -->
<section class="content">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- render shortcuts area-->
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
    <?php //$this->include('app/shortcut'); ?>
    </section>
    <!-- /.content -->
 <section class="content">
      <div class="container mx-auto">
		<?= $this->include('app/alerts') ?>

		</div>
      <!-- /.container-fluid -->
    </section>
   <hr>
 <!-- Formulario Crear Expediente -->
    <div class="container-fluid">
       
        <div class="form-three widget-shadow">
<div class="container-fluid mt-4">
    <h3 class="mb-4">Crear expediente</h3>

    <form method="post" action="<?= site_url('dossier-insert') ?>" class="needs-validation" novalidate enctype="multipart/form-data">

        <!-- Fila 1 -->
        <div class="row mb-3">
            <!-- Código -->
            <div class="col-md-4">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" name="codigo" class="form-control" id="codigo"
                       value="<?= isset($codigo) ? $codigo : '' ?>" readonly>
                <small class="text-muted">Ej: EXP-2026-ABC123</small>
            </div>

            <!-- Título -->
            <div class="col-md-4">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Título del expediente" required>
                <small class="text-muted">Ej: Expediente inicial</small>
            </div>

            <!-- descripcion -->
           <div class="col-md-4 mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea 
        name="descripcion" 
        id="descripcion" 
        class="form-control" 
        rows="4" 
        placeholder="Ingrese la descripción del expediente"
        required><?= old('descripcion') ?></textarea>
</div>
        </div>

        <!-- Fila 2 -->
       <div class="row mb-3">
    <!-- Departamento actual -->
    <?php if($user_can_change): ?>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="departamento_actual" class="form-label">Departamento inicial</label>
                <select name="departamento_actual" id="departamento_actual" class="form-select">
                    <?php foreach($departamentos as $dep): ?>
                        <option value="<?= $dep['id']; ?>" <?= ($dep['id'] == 1) ? 'selected' : '' ?>>
                            <?= $dep['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small class="text-muted">Por defecto es Recepción, cambiar solo si tiene permiso</small>
            </div>
        </div>
        <?php 
            $asignadoCol = 'col-md-4';
            $prioridadCol = 'col-md-4';
        ?>
    <?php else: ?>
        <input type="hidden" name="departamento_actual" value="1">
        <?php 
            $asignadoCol = 'col-md-6';
            $prioridadCol = 'col-md-6';
        ?>
    <?php endif; ?>

    <!-- Asignado a -->
    <div class="<?= $asignadoCol ?>">
        <label for="asignado_a" class="form-label">Asignado a</label>
        <input type="text" name="asignado_a" class="form-control" id="asignado_a" placeholder="Nombre del responsable">
        <small class="text-muted">Ej: Juan Pérez</small>
    </div>

    <!-- Prioridad -->
    <div class="<?= $prioridadCol ?>">
        <label for="prioridad" class="form-label">Prioridad</label>
        <select name="prioridad" class="form-control" id="prioridad">
            <option value="1">Alta</option>
            <option value="2">Media</option>
            <option value="3">Baja</option>
        </select>
        <small class="text-muted">Seleccione prioridad</small>
    </div>
</div>

        <!-- Fila 3 -->
        <div class="row mb-3">
            <!-- Nivel de confidencialidad -->
            <div class="col-md-4">
                <label for="nivel_confidencialidad" class="form-label">Nivel de confidencialidad</label>
                <select name="nivel_confidencialidad" class="form-control" id="nivel_confidencialidad">
                    <option value="1">Confidencial</option>
                    <option value="2">Normal</option>
                    <option value="3">Público</option>
                </select>
                <small class="text-muted">Seleccione nivel</small>
            </div>

            <!-- Estado -->
            <div class="col-md-4">
                 <div class="col-md-4 mb-3">
					<label for="estado_id" class="form-label">Estado</label>
					<select name="estado_id" class="form-select" id="estado_id">
						<option value="">Seleccione un estado</option>
						<?php foreach($estados as $estado): ?>
							<option value="<?= $estado['id']; ?>">
								<?= $estado['nombre']; ?>
							</option>
						<?php endforeach; ?>
					</select>
					<small class="text-muted">Seleccione el estado del expediente</small>
				</div>
            </div>

            <!-- Adjuntar expedientes (varios) -->
           <div class="col-md-4 mb-3">
				<label for="tipo_expedientes" class="form-label">Tipo de expediente</label>
				<select name="tipo_expedientes" id="tipo_expedientes" class="form-select">
					<option value="">Seleccione un tipo</option>
					<?php foreach($tipos as $tipo): ?>
						<option value="<?= $tipo['id']; ?>"><?= $tipo['nombre']; ?></option>
					<?php endforeach; ?>
				</select>
				
			</div>

			
        </div>

        <!-- Fila 4: adjuntos -->
<div class="row mb-3">
<div class="col-md-12">
<div class="form-group">
   <label for="expedientes">Adjuntar expedientes</label>
    <input type="file" name="expedientes[]" id="expedientes" multiple class="form-control">
    <small class="form-text text-muted">Puedes seleccionar varios archivos PDF al mismo tiempo.</small>

    <!-- Lista donde se mostrarán los archivos seleccionados -->
    <ul id="lista-archivos" class="list-group mt-2"></ul>
</div>
<script>
const inputFiles = document.getElementById('expedientes');
const listaArchivos = document.getElementById('lista-archivos');

// Array solo para mostrar la lista y eliminar archivos visualmente
let archivosSeleccionados = [];

// Cuando el usuario selecciona archivos
inputFiles.addEventListener('change', (e) => {
    const nuevos = Array.from(e.target.files);

    // Agregamos los nuevos archivos a la lista visual
    archivosSeleccionados = archivosSeleccionados.concat(nuevos);
    renderLista();
});

// Función para mostrar la lista de archivos
function renderLista() {
    listaArchivos.innerHTML = '';
    archivosSeleccionados.forEach((file, index) => {
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        li.textContent = file.name;

        // Botón eliminar
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn btn-sm btn-danger';
        btn.textContent = 'Eliminar';
        btn.addEventListener('click', () => {
            // Solo eliminamos de la lista visual
            archivosSeleccionados.splice(index, 1);
            renderLista();

            // ⚠ No necesitamos modificar input.files
            // PHP seguirá recibiendo lo que el usuario deje seleccionado en el input
        });

        li.appendChild(btn);
        listaArchivos.appendChild(li);
    });
}
</script>
<style>
	/* Contenedor del formulario */
.form-three {
    background: #ffffff;
    padding: 30px;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

/* Título */
.form-three h3 {
    font-weight: 600;
    color: #2c3e50;
}

/* Labels */
.form-label {
    font-weight: 500;
    font-size: 14px;
    color: #34495e;
    margin-bottom: 6px;
}

/* Inputs y selects */
.form-control,
.form-select {
    border-radius: 10px;
    border: 1px solid #dcdfe6;
    padding: 10px 14px;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: #f9fafc;
}

/* Hover */
.form-control:hover,
.form-select:hover {
    border-color: #4e73df;
    background-color: #ffffff;
}

/* Focus */
.form-control:focus,
.form-select:focus {
    border-color: #4e73df;
    box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.15);
    background-color: #ffffff;
}

/* Small text */
.text-muted,
.form-text {
    font-size: 12px;
    color: #7f8c8d !important;
}

/* File input */
input[type="file"] {
    padding: 8px;
    background: #f1f3f9;
    border-radius: 10px;
}

/* Lista archivos */
#lista-archivos .list-group-item {
    border-radius: 8px;
    margin-bottom: 5px;
    border: none;
    background: #f8f9fc;
    font-size: 14px;
}

/* Botón eliminar archivo */
#lista-archivos .btn-danger {
    border-radius: 8px;
    padding: 4px 10px;
    font-size: 12px;
}

/* Botón principal */
.btn-primary {
    background: linear-gradient(135deg, #4e73df, #1cc88a);
    border: none;
    border-radius: 10px;
    padding: 12px;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
}

/* Hover botón */
.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(78, 115, 223, 0.3);
}

/* Separación más elegante entre filas */
.row.mb-3 {
    margin-bottom: 25px !important;
}

/* Breadcrumb más suave */
.breadcrumb {
    background: transparent;
}

/* Responsive mejora */
@media (max-width: 768px) {
    .form-three {
        padding: 20px;
    }
}
</style>
<script>
const inputFiles = document.getElementById('expedientes');
const listaArchivos = document.getElementById('lista-archivos');
let archivosSeleccionados = [];

inputFiles.addEventListener('change', (e) => {
    // Convertimos FileList en array
    const nuevos = Array.from(e.target.files);

    // Agregamos a los ya seleccionados
    archivosSeleccionados = archivosSeleccionados.concat(nuevos);

    renderLista();
    // Limpiar input para poder re-agregar los mismos archivos si se desea
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

// Antes de enviar, reemplazar la FileList por nuestro array
document.querySelector('form').addEventListener('submit', (e) => {
    if (archivosSeleccionados.length > 0) {
        const dataTransfer = new DataTransfer();
        archivosSeleccionados.forEach(f => dataTransfer.items.add(f));
        inputFiles.files = dataTransfer.files;
    }
});
</script>
            </div>
        </div>

        <!-- Botón enviar -->
        <div class="row mb-3 justify-content-center">
            <div class="col-md-4 d-grid">
                <button type="submit" class="btn btn-primary btn-block">Crear expediente</button>
            </div>
        </div>

    </form>
</div>
        </div>
    </div>
</div>


  </div>
</section>
  <?= $this->include('app/footer') ?>




