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
						<h3 class="title1">Crear Usuarios:</h3>
						<div class="form-three widget-shadow">
                            
							
						</div>
					</div>

					  </div>
      <!-- /.container-fluid -->
    </section>

<form action="<?php echo site_url('users-insert'); ?>" method="post" enctype="multipart/form-data" class="">
    <div class="card-body">

        <div class="row">
            <!-- Nombre -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
                </div>
            </div>

            <!-- Apellido -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Email -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email" placeholder="Correo electrónico" required>
                </div>
            </div>

            <!-- Contacto -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contacto">Contacto</label>
                    <input type="text" class="form-control" name="contacto" placeholder="Teléfono o contacto" required>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Contraseña -->
            <div class="col-md-4">
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                </div>
            </div>

            <!-- Role -->
            <div class="col-md-4">
                <div class="form-group">
                    <label>Seleccione role</label>
                    <select name="role_id" class="form-control select2" style="width: 100%;" required>
                        <?php foreach ($roles as $role) : ?>
                            <option value="<?= $role['id']; ?>"><?= $role['role_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Departamento -->
            <div class="col-md-4">
                <div class="form-group">
                    <label>Seleccione departamento</label>
                    <select name="departamento_id" class="form-control select2" style="width: 100%;" required>
                        <?php foreach ($departamentos as $dep) : ?>
                            <option value="<?= $dep['id']; ?>"><?= $dep['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Imagen de perfil -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="profile_image">Imagen de perfil (opcional)</label>
                    <input type="file" class="form-control" name="profile_image">
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




