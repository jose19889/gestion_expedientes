<?= $this->include('app/header') ?>
<?= $this->section('content') ?>

<section class="content">
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container mx-auto">
        <?= $this->include('app/alerts') ?>
       
<div class="container mt-4">
    <h3>Asignar Expediente: <?= esc($expediente->codigo) ?></h3>

    <!-- Mensajes Flash -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('asign-save/'.$expediente->id) ?>" method="post">
        <div class="mb-3">
            <label for="usuario_id" class="form-label">Asignar a Usuario:</label>
           <select name="usuario_id" id="usuario_id" class="form-select" required>
                <option value="">-- Seleccionar usuario --</option>
                <?php foreach($usuarios as $usuario): ?>
                    <option value="<?= esc($usuario->id) ?>">
                        <?= esc($usuario->nombre . ' ' . $usuario->apellido) ?>
                        <?php if(isset($usuario->role_name)): ?>
                            (<?= esc($usuario->role_name) ?>)
                        <?php endif; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Asignar</button>
        <a href="<?= site_url('dossiers') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

        
      </div>
    </section>
  </div>
</section>

<?= $this->include('app/footer') ?>