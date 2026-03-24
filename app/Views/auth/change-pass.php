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
					
    <h2>Cambiar contraseña de Usuario</h2>
						<div class="form-three widget-shadow">
                            
							
						</div>
					</div>

					  </div>
      <!-- /.container-fluid -->
    </section>


<div class="card">
  <div class="card-body">
<?= $this->include('app/alerts') ?>
<p class="text-danger"><?= session()->getFlashdata('error'); ?> </p>

<form action="<?= site_url('users-changePass') ?>" method="post" class="form-horizontal">
    <?= csrf_field(); ?>

    <div class="card-body">
            <div class="row">
              <div class="col-md-4">
               <div class="form-group">


                  <label for="old_password">Old Password:</label>
                  <input type="password" name="old_password"  class="form-control" id="old_password" required>
                   
                  </div>
              </div>
              <!-- /.col -->
              <div class="col-md-4">
               <div class="form-group">

                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" class="form-control"  id="new_password" required>

                   
                  </div>
              </div>

              <div class="col-md-4">
               <div class="form-group">

                 <label for="confirm_password">Confirm New Password:</label>
                 <input type="password" name="confirm_password"  class="form-control"  id="confirm_password" required>



                   
                  </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
           
             

              <!-- /.col -->
            </div>

    <div class="form-group text-center">
        <input type="submit" value="Guardar">
    </div>
</form>
  </div>
  </div>
    </div>
</section>
  <?= $this->include('app/footer') ?>




