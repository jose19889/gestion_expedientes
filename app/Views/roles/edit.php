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
       <?php /*= $this->include('app/shortcut') */ ?>
 
    </section>
    <!-- /.content -->
 <section class="content">
      <div class="container-fluid">
		<?= $this->include('app/alerts') ?>
		<div class="row">
						<h3 class="title1">Editar Roles:</h3>
						<div class="form-three widget-shadow">
                            
							
						</div>
					</div>

					  </div>
      <!-- /.container-fluid -->
    </section>


      <form  action="<?php echo site_url('roles-update');?>" method="post" class="">
      		<input type="hidden" class="form-control1" name="id"  Value="<?php echo  $role_obj['id'];?>" >
       <div class="card-body">
            <div class="row">
              <div class="col-md-6">
               <div class="form-group">
                    <label for="formData">Nombre del Role</label>
                  

                    <input type="text" class="form-control" name="role_name" 
                                         Value="<?php echo $role_obj['role_name'];?>" placeholder="nombre">
                  </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6">

              <div class="form-group">
                <label for="formData">Descripcion</label>
                <textarea class="form-control" rows="3" name="description" id=""> <?php echo $role_obj['description']; ?></textarea>
              </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
           
         
            <!-- /.row -->
          </div>


           <div class="form-group text-center">
                <input type="submit" turno="submit" value="Guardar " />
            </div>
                                
          </form>
  </div>
</section>
  <?= $this->include('app/footer') ?>




