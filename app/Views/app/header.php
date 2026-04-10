
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>GESTION EXPEDIENTES</title>

<!-- // datatables-->
<link href="<?php echo base_url();?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"> 
<link href="<?php echo base_url();?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css" rel="stylesheet"> 
<link href="<?php echo base_url();?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css" rel="stylesheet"> 

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link href="<?php echo base_url();?>plugins/fontawesome-free/css/all.min.css" rel='stylesheet' type='text/css' />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
   <link href="<?php echo base_url();?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" rel='stylesheet' type='text/css' />
  <!-- iCheck -->
   <link href="<?php echo base_url();?>plugins/icheck-bootstrap/icheck-bootstrap.min.css" rel='stylesheet' type='text/css' />
  <!-- JQVMap -->
     <link href="<?php echo base_url();?>plugins/jqvmap/jqvmap.min.css" rel='stylesheet' type='text/css' />
  <!-- Theme style -->
    <link href="<?php echo base_url();?>dist/css/adminlte.min.css" rel='stylesheet' type='text/css' />
  <!-- overlayScrollbars -->
    <link href="<?php echo base_url();?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css" rel='stylesheet' type='text/css' />
  <!-- Daterange picker -->
   <link href="<?php echo base_url();?>plugins/daterangepicker/daterangepicker.css" rel='stylesheet' type='text/css' />
  <!-- summernote -->
    <link href="<?php echo base_url();?>plugins/summernote/summernote-bs4.min.css" rel='stylesheet' type='text/css' />
   <!-- datatables-->
    
 <link  href="<?php echo base_url();?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"  rel='stylesheet' type='text/css' >
  <link  href="<?php echo base_url();?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css" rel='stylesheet' type='text/css' >
  <link  href="<?php echo base_url();?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css" rel='stylesheet' type='text/css' >
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <!--<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>-->

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo site_url('home');?>" class="nav-link">Home</a>

      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>

      <li class="nav-item">
    <a href="<?= site_url('migration') ?>" class="nav-link">
        <i class="fa fa-database"></i> 
        <span>Respaldos de Base de Datos</span>
    </a>
</li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>
      
<?= $this->include('app/notification') ?>
      <li class="nav-item dropdown user-menu">

         <?php
              // Access session data
             $session = session();
            $username = $session->get('nombre');
            $roleId   = $session->get('role_id');
            $roleName = $session->get('role_name');
            $userId   = $session->get('user_id'); // ✅ correcto

            $userModel = new \App\Models\UserModel();
            $user = $userModel->find($userId);

            if ($user && !empty($user['profile_image'])) {
                $imageUrl = base_url('uploads/profiles/' . $user['profile_image']);
            } else {
                $imageUrl = base_url('uploads/img/avatar5.png');
            }
              ?>
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <img src="<?= esc($imageUrl); ?>" class="user-image img-circle elevation-2" alt="User Image">
          <span class="d-none d-md-inline"><?= esc($username); ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <!-- User image -->


          <li class="user-header bg-primary">

            
            <img src="<?= esc($imageUrl); ?>" class="img-circle elevation-2" alt="User Image">

            <p>
            <?= esc($username); ?>
              <small><?= esc($roleName); ?></small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
             
              <div class="col-12 text-center ">
                <a  class="text-danger" href="users-changePass">Cambiar Contraseña</a>
              </div>
            
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="<?= site_url('users-uploadphoto') ?>" class="btn btn-default btn-flat">Editar foto</a>
            <a href="<?= site_url('quit'); ?>" class="btn btn-default btn-flat float-right">Salir</a>
          </li>
        </ul>
      </li>

      
      <!-- Notifications Dropdown Menu -->
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>

      
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->


<?= $this->include('app/sidenav') ?>
   <!-- /.content-wrapper -->

