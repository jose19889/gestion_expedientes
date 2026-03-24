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
      <?php /*= $this->include('app/shortcut') */ ?>
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
                <h3 class="card-title">LISTADO DE ROLES</h3>
              </div>
              <!-- /.card-header -->
            <?= $this->include('app/alerts') ?>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
            <a  href="roles-create" class="btn btn-app  small">
                  <span class="badge bg-purple"></span>
                  <i class="fas fa-plus text-success"></i> <b>Crear Roles</b>
                </a>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
               </th>
                <th>Número</th>
                <th>Nombre </th>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>
            </tr>
                  </thead>
                  <tbody>
                 <?php $n = 0; ?>
                <?php if ($roles): ?>
                    <?php foreach ($roles as $role): ?>
                        <tr>
                            <!-- Incrementing the counter and displaying it in the table -->
                            <td><?php echo ++$n; ?></td>
                            <td><?php echo $role['role_name']; ?></td>
                            <td><?php echo $role['description']; ?></td>
                            <td>
                                <i class="fa fa-edit">
                                    <a href="<?php echo base_url('roles-edit/'.$role['id']); ?>">Editar</a>
                                </i> |
                                <?php helper('role'); ?>
                                <i class="text-danger fa fa-trash">
                                    <a href="<?php echo base_url('roles-delete/'.$role['id']); ?>" onclick="return confirm('¿Desea borrar este registro?');">Eliminar</a>
                                </i> 
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>


                  </tbody>
                  <tfoot>
                 <tr>
               </th>
                <th>Número</th>
                <th>Nombre </th>
                <th>Descripcion</th>
                <th>Acciones</th>
            </tr>
                  </tfoot>
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
 