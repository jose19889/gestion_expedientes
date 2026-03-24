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
   
 
    </section>
    <!-- /.content -->
 <section class="content">
      <div class="container-fluid">
		<?= $this->include('app/alerts') ?>
		<div class="row">
						<h3 class="title1">Editar Usuarios:</h3>
						<div class="form-three widget-shadow">
                            
							
						</div>
					</div>

					  </div>
      <!-- /.container-fluid -->
    </section>
<form action="<?php echo site_url('users-update'); ?>" method="post" enctype="multipart/form-data" class="">
    <input type="hidden" name="id" value="<?php echo $user_obj['id']; ?>">

    <div class="card-body">

        <div class="row">
            <!-- Nombre -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $user_obj['nombre']; ?>">
                </div>
            </div>

            <!-- Apellido -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $user_obj['apellido']; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Email -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_obj['email']; ?>">
                </div>
            </div>

            <!-- Contacto -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contacto">Contacto</label>
                    <input type="text" class="form-control" id="contacto" name="contacto" value="<?php echo $user_obj['contacto']; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Role -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Seleccione role</label>
                    <select name="role_id" class="form-control select2" style="width: 100%;">
                        <?php foreach($roles as $role): ?>
                            <option value="<?= $role['id'] ?>"
                                <?php if ($user_obj['role_id'] == $role['id']) echo 'selected'; ?>>
                                <?= $role['role_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Departamento -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Seleccione departamento</label>
                    <select name="departamento_id" class="form-control select2" style="width: 100%;">
                        <?php foreach($departamentos as $dep): ?>
                            <option value="<?= $dep['id'] ?>"
                                <?php if ($user_obj['departamento_id'] == $dep['id']) echo 'selected'; ?>>
                                <?= $dep['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Profile Image -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="profile_image">Imagen de perfil</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                    <?php if (!empty($user_obj['profile_image'])): ?>
                        <small>Imagen actual:</small><br>
                        <img src="<?php echo base_url('uploads/profiles/' . $user_obj['profile_image']); ?>" 
                             alt="Profile Image" style="width: 100px; height:auto; margin-top:5px;">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-group text-center">
            <input type="submit" class="btn btn-primary" value="Guardar">
        </div>

    </div>
</form>
  </div>
</section>
  <?= $this->include('app/footer') ?>




