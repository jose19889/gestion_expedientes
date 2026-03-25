<li class="nav-item dropdown">
  <a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>

    <?php if (isset($unreadCount) && $unreadCount > 0): ?>
      <span class="badge badge-danger navbar-badge">
        <?= $unreadCount ?>
      </span>
    <?php endif; ?>
  </a>

  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow">

    <!-- Header -->
    <span class="dropdown-item dropdown-header">
      <?= isset($unreadCount) ? $unreadCount : 0 ?> Notificaciones
    </span>

    <div class="dropdown-divider"></div>

    <!-- Lista -->
    <div style="max-height: 300px; overflow-y: auto;">

      <?php if (isset($notificaciones) && !empty($notificaciones)): ?>
        <?php foreach ($notificaciones as $n): ?>

          <a href="<?= !empty($n->url) ? site_url($n->url) : '#' ?>"
             class="dropdown-item <?= ($n['leido'] == 0) ? 'bg-light' : '' ?>">

            <i class="fas fa-info-circle mr-2 text-primary"></i>

            <span class="font-weight-bold">
              <?= esc($n['titulo']) ?>
            </span>

            <div class="text-sm text-muted">
              <?= esc($n['mensaje']) ?>
            </div>

            <span class="float-right text-muted text-sm">
              <?= date('H:i', strtotime($n['created_atg'])) ?>
            </span>

          </a>

          <div class="dropdown-divider"></div>

        <?php endforeach; ?>
      <?php else: ?>
        <span class="dropdown-item text-center text-muted">
          No hay notificaciones
        </span>
      <?php endif; ?>

    </div>

    <!-- Footer -->
    <a href="<?= site_url('notificaciones') ?>" class="dropdown-item dropdown-footer">
      Ver todas las notificaciones
    </a>

  </div>
</li>