<?php
$unreadCount    = $navbarData['unreadCount'] ?? 0;
$notificaciones = $navbarData['notificaciones'] ?? [];
$userRoleId     = $navbarData['userRoleId'] ?? 0;
$userIp         = $navbarData['userIp'] ?? '0.0.0.0';
?>

<li class="nav-item dropdown">
  <a class="nav-link" data-toggle="dropdown" href="#">
    <i class="far fa-bell"></i>
    <?php if ($unreadCount > 0): ?>
      <span class="badge badge-danger navbar-badge"><?= esc($unreadCount) ?></span>
    <?php endif; ?>
  </a>

  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow">
    <span class="dropdown-item dropdown-header">
      <?= esc($unreadCount) ?> Notificación<?= ($unreadCount == 1) ? '' : 'es' ?>
    </span>
    <div class="dropdown-divider"></div>

    <div style="max-height: 300px; overflow-y: auto;">
      <?php if (!empty($notificaciones)): ?>
        <?php foreach ($notificaciones as $n): ?>
          <a href="<?= ($userRoleId == 2 && !empty($n['id'])) 
                        ? site_url('inbox-open/'.$n['id']) 
                        : '#' ?>"
             class="dropdown-item <?= ($n['leido'] == 0) ? 'bg-light font-weight-bold noti-bloqueada' : '' ?>"
             <?= ($userRoleId != 2) ? 'title="Solo el jefe puede abrir"' : '' ?>>
            <i class="fas fa-info-circle mr-2 text-primary"></i>
            <span><?= esc($n['titulo']) ?></span>
            <div class="text-sm text-muted"><?= esc($n['mensaje']) ?></div>
            <span class="float-right text-muted text-sm"><?= date('H:i', strtotime($n['created_at'])) ?></span>
          </a>
          <div class="dropdown-divider"></div>
        <?php endforeach; ?>
      <?php else: ?>
        <span class="dropdown-item text-center text-muted">No hay notificaciones</span>
      <?php endif; ?>
    </div>

    <!-- Mostrar IP del usuario -->
    <div class="dropdown-item text-right text-muted small">
      Tu IP: <?= esc($userIp) ?>
    </div>

    <a href="<?= site_url('inbox-view') ?>" class="dropdown-item dropdown-footer">
      Ver todas las notificaciones
    </a>
  </div>
</li>