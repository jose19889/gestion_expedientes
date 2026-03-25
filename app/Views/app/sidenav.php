<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url('home') ?>" class="brand-link">
        <img src="<?= base_url('uploads/logo/app-icon2.png') ?>" alt="Logo-app" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">GEST-EX</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block text-white">
                    <i class="fas fa-user-circle me-1"></i> 
                    <?= session()->get('nombre') ?? 'Usuario' ?>
                </a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="<?= base_url('home') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>ESTADÍSTICAS <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('home') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ESTADÍSTICAS EN GRÁFICOS</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <?php if (session()->get('role_id') == 1): // Asumiendo 1 = Admin ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>USUARIOS Y ROLES <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('users-list') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>LISTADO DE USUARIOS</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('roles-list') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>ROLES</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>EXPEDIENTES <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('dossiers') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>LISTA DE EXPEDIENTES</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('reports') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>EXPEDIENTES ASIGNADOS</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calculator"></i>
                        <p>CONTABILIDAD <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('news-backend') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>HISTORIAL</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-contract"></i>
                        <p>LEGISLACIÓN <i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('files_view') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>VER DOCUMENTOS</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('quit') ?>" class="nav-link text-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>CERRAR SESIÓN</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>