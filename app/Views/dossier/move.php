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
        <div class="row">
         
          <div class="form-three widget-shadow">
            <!-- Aquí podrías agregar información adicional si quieres -->
          </div>
        </div>

        <h4>Mover Expediente: <?= esc($expediente->codigo); ?></h4>

        <form method="post" action="<?= base_url('move-update/'.$expediente->id); ?>">
          <?= csrf_field(); ?>

          <div class="mb-3">
            <label>Nuevo Departamento</label>
            <select name="departamento_id" class="form-control" required>
              <?php foreach($departamentos as $dep): ?>
                  <option value="<?= $dep->id; ?>">
                      <?= esc($dep->nombre); ?>
                  </option>
              <?php endforeach; ?>
            </select>


           
          </div>

          <div class="mb-3">
            <label>Comentario</label>
            <textarea name="comentario" class="form-control"></textarea>
          </div>

          <button type="submit" class="btn btn-success">Mover Expediente</button>
        </form>
      </div>
    </section>
  </div>
</section>

<?= $this->include('app/footer') ?>