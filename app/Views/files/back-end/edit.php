

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
                <h3 class="card-title"><b>LISTADO DE DOCUMENTOS</b></h3>

              <br>
              <hr>
             


              </div>
              <!-- /.card-header -->

            <?= $this->include('app/alerts') ?>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
          
              <!-- /.card-header -->
              <div class="card-body">
                  <h2>Editar archivo</h2>

                  <?php if (isset($validation)): ?>
                      <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                  <?php endif; ?>

                  <form action="<?= base_url('file/file_edit/' . $file['id']) ?>" method="post" enctype="multipart/form-data">
                      <?= csrf_field() ?>

                    
                      <div class="mb-3">
                          <label for="file_desc" class="form-label">Nombre del Fichero</label>
                          <textarea name="file_desc" id="file_desc" class="form-control" required><?= esc($file['file_desc']) ?></textarea>
                      </div>

                      <div class="mb-3">
                          <label for="file_upload" class="form-label">Reemplazar archivo (opcional)</label>
                          <input type="file" name="file_upload" class="form-control">
                          <p class="text-muted">Archivo actual: <?= esc($file['file_path']) ?></p>
                      </div>

                      <button type="submit" class="btn btn-primary">Actualizar</button>
                      <a href="<?= base_url('files') ?>" class="btn btn-secondary">Cancelar</a>
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
 

