<?= $this->include('app/header') ?>
<?= $this->section('content') ?>

<section class="content">
  <div class="content-wrapper">

    <!-- Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><i class="fas fa-bell"></i> Centro de Notificaciones</h1>
          </div>
          <div class="col-sm-6 text-right">
            <a href="<?= site_url('notifications/marcarTodas') ?>" class="btn btn-success">
              <i class="fas fa-check-double"></i> Marcar todas como leídas
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Contenido -->
    <section class="content">
      <div class="container-fluid">

        <div class="card">
          <div class="card-body p-0">
            <table class="table table-hover">
              <thead class="bg-light">
                <tr>
                  <th>Estado</th>
                  <th>Título</th>
                  <th>Mensaje</th>
                  <th>Fecha</th>
                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($notificaciones)): ?>
                  <?php foreach($notificaciones as $n): ?>
                    <tr class="<?= ($n['leido']==0) ? 'table-warning' : '' ?>">
                      <td>
                        <?= ($n['leido']==0) 
                             ? '<span class="badge badge-danger">Nueva</span>' 
                             : '<span class="badge badge-secondary">Leída</span>' ?>
                      </td>
                      <td><?= esc($n['titulo']) ?></td>
                      <td><?= esc($n['mensaje']) ?></td>
                      <td><?= date('d/m/Y H:i', strtotime($n['created_at'])) ?></td>
                      <td>
                        <?php if($userRoleId == 2 && !empty($n['url'])): ?>
                          <!-- Jefe: abrir expediente -->
                          <a href="<?= site_url('inbox-open/'.$n['id']) ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-folder-open"></i> Abrir
                          </a>
                        <?php else: ?>
                          <!-- Usuario normal: marcar como leído -->
                          <a href="<?= site_url('mark-as-read/'.$n['id']) ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-check"></i> Marcar como leído
                          </a>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="5" class="text-center text-muted p-4">
                      <i class="far fa-bell fa-2x mb-2"></i><br>
                      No hay notificaciones
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>

  </div>
</section>

<?= $this->include('app/footer') ?>