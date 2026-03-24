<?= $this->include('app/header') ?>
<?= $this->section('content') ?>
  <!-- Main Sidebar Container -->
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
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
      
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
         
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><b>CREAR NOTICIA</b></h3>

              <br>
              <hr>
             


              </div>
              <!-- /.card-header -->

           
<?php if(session()->has('errors')): ?>
  <div class="alert alert-danger">
    <ul>
      <?php foreach(session('errors') as $error): ?>
        <li><?= esc($error) ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
          
              <!-- /.card-header -->
              <div class="card-body">
             <form action="<?= base_url('file/create') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

              

                <div class="mb-3">
                    <label for="file_desc" class="form-label">Descripción del archivo</label>
                   <input type="text" name="file_desc" id="file_desc" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="file_upload" class="form-label">Selecciona el archivo</label>
                    <input type="file" name="file_upload" id="file_upload" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Archivo</button>
            </form>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    
  </div>
</section>
 
  <?= $this->include('app/footer') ?>
 