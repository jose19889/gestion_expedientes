

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
                <h3 class="card-title"><b>LISTADO DE DENUNCIAS DE ANTICORUPCIÓN</b></h3>

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
<a class="btn btn-primary" href="<?= base_url('file/create') ?>">Crear Nuevo</a>
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre del archivo</th>
            <th>Descargar</th>
            <th>Ver</th>
            <th>Acciones</th> <!-- Nueva columna -->
        </tr>
    </thead>
    <tbody>
        <?php $count = 1; ?>
        <?php foreach ($files as $file): ?>
            <tr>
                <td><?= $count++ ?></td>
                <td><?= esc($file['file_desc']) ?></td>
                <td>
                    <a href="<?= base_url('uploads/' . $file['file_path']) ?>" download class="btn btn-sm btn-success">
                        <i class="fa fa-download"></i> Descargar
                    </a>
                </td>
                <td>
                    <a href="<?= base_url('uploads/' . $file['file_path']) ?>" target="_blank" class="btn btn-sm btn-primary">
                        <i class="fa fa-eye"></i> Ver
                    </a>
                </td>
                <td>
                    <!-- Editar botón -->
                    <a href="<?= base_url('file/file_edit/' . $file['id']) ?>" class="btn btn-sm btn-warning">
                        <i class="fa fa-edit"></i> Editar
                    </a>

                    <!-- Eliminar botón -->
                 
             
                  <form action="<?= base_url('file/file_remove/' . $file['id']) ?>" method="post" style="display:inline-block;" 
                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar este archivo?');">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i> Eliminar
                    </button>
                </form>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



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
 

