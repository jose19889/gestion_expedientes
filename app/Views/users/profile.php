
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
						<h3 class="title1">Cargar Foto de usuario:</h3>
						<div class="form-three widget-shadow">
                            
							
						</div>
					</div>

					  </div>
      <!-- /.container-fluid -->
    </section>

    <div class="card">
<form action="<?= site_url('users-changephoto') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field(); ?>

    <label for="profile_image">Profile Image:</label>
    <input type="file" name="profile_image" id="profile_image" accept="image/*">

    <div class="form-group ">
        <input type="submit" value="Guardar">
    </div>
</form>
</div>

<?php if (session()->get('error')): ?>
    <div class="error"><?= session()->get('error'); ?></div>
<?php endif; ?>

<?php if (session()->get('success')): ?>
    <div class="success"><?= session()->get('success'); ?></div>
<?php endif; ?>

      
  </div>
</section>
  <?= $this->include('app/footer') ?>




