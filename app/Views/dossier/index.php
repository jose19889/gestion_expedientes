<?= $this->include('app/header') ?>
<?= $this->section('content') ?>

<section class="content">
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Listado de Expedientes</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Filtros de búsqueda -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><b>Filtros de Expedientes</b></h3>
            <br>
             <p><?= $this->include('app/alerts') ?></p>
            <hr>
            <form action="<?= site_url('dossiers'); ?>" method="get">
              
              <!-- Departamento -->
              <label for="departamento">Departamento:</label>
              <select name="departamento" id="departamento">
                <option value="">Todos</option>
                <?php foreach($departamentos as $dep): ?>
                  <option value="<?= esc($dep['id']); ?>" <?= (isset($filtros['departamento']) && $filtros['departamento'] == $dep['id']) ? 'selected' : ''; ?>>
                    <?= esc($dep['nombre']); ?>
                  </option>
                <?php endforeach; ?>
              </select>

              <!-- Estado -->
              <label for="estado">Estado:</label>
              <select name="estado" id="estado">
                <option value="">Todos</option>
                <?php foreach($estados as $est): ?>
                  <option value="<?= esc($est['id']); ?>" <?= (isset($filtros['estado']) && $filtros['estado'] == $est['id']) ? 'selected' : '' ?>>
                    <?= esc($est['nombre']); ?>
                  </option>
                <?php endforeach; ?>
              </select>

              <!-- Botones -->
              <button type="submit">Filtrar</button>
              <button type="button" onclick="window.location.href='<?= site_url('dossiers'); ?>'">Limpiar</button>

            </form>
          </div>
        </div>

        <!-- Tabla de expedientes -->
        <div class="card">
          <div class="card-body">
                <a  href="create-dossier" class="btn btn-app  small">
                  <span class="badge bg-purple"></span>
                  <i class="fas fa-plus text-success"></i> <b>Crear Usuario</b>
                </a>

          </div>
          <div class="card-body">
           

           <!-- Filtros -->
<div class="card-body">
    <!-- Tabla de expedientes -->
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Departamento</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Confidencialidad</th>
                <th>Fecha Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php if(!empty($expedientes)): ?>
                <?php foreach($expedientes as $exp): ?>
                    <tr>
                        <td><?= esc($exp->id); ?></td>
                        <td><?= esc($exp->codigo); ?></td>
                        <td><?= esc($exp->titulo); ?></td>
                        <td><?= esc($exp->descripcion); ?></td>
                        <td><?= esc($exp->departamento_name); ?></td>
                        <td><?= esc($exp->prioridad); ?></td>
                        <td>
                            <?php 
                                $estado = $exp->estado_nombre ?? 'Sin estado';
                                $color  = $exp->estado_color ?? 'secondary';
                            ?>
                            <span class="text-<?= esc($color); ?>"><?= esc($estado); ?></span>
                        </td>
                        <td><?= esc($exp->nivel_confidencialidad); ?></td>
                        <td><?= esc($exp->fecha_creacion); ?></td>
                        <td>
                            <a href="<?= site_url('view-dossier/'.$exp->id); ?>" class="fa fa-eye btn btn-info btn-sm mb-1"> Ver</a>
                            <a href="<?= site_url('dossier-edit/'.$exp->id); ?>" class="fa fa-edit btn btn-warning btn-sm mb-1"> Editar</a>
                            <a href="<?= site_url('download-pdf/'.$exp->id); ?>" class="fa fa-file-pdf btn btn-danger btn-sm mb-1"> PDF</a>
                             <!-- Botón Mover -->
                            <?php //if(in_array($userRoleId, [1,2])): ?>
                                <a href="<?= site_url('move-dossier/'.$exp->id); ?>" 
                                  class="btn btn-secondary btn-sm mb-1">
                                  Mover
                                </a>
                            <?php// endif; ?>

                            <!-- Botón Asignar solo para Director (1) y Jefe de Sección (2) -->
                            <?php if(in_array($userRoleId, [1,2])): ?>
                                <a href="<?= base_url('assign-edit/'.$exp->id) ?>" class="btn btn-primary btn-sm mb-1">Asignar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" class="text-center">No hay expedientes registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>

        <tfoot>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Departamento</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Confidencialidad</th>
                <th>Fecha Creación</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
    </table>
</div> </div>
        </div>

      </div>
    </section>

  </div>
</section>

<?= $this->include('app/footer') ?>