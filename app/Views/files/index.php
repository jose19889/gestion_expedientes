
<?= $this->include('app/header-portal') ?>

  
<main>

 <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/anti.png);">
      <div class="container">
        <h1>Documentos de legislacion</h1>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Portada</a></li>
            <li class="current"></li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->
 	   <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Documentos de legislacion</h2>
  </div><!-- End Section Title -->

	<div class="container">
      <div class="row">
        <div class="col-lg-8">
  <!-- Blog Posts Section -->
<table id="filesTable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre del archivo</th>
            <th>Descargar</th>
            <th>Ver</th>
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
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>


        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Search Widget -->
            <div class="search-widget widget-item">

              <h3 class="widget-title">Buscador</h3>
              <form action="">
                <input type="text">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>

            </div><!--/Search Widget -->

          

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Publicidad</h3>

              <div class="post-item">
                <img src="assets/img/blog/blog-recent-1-1.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.html">Hotel Anda China</h4>
                  <time datetime="2024-01-03">Abril 1, 2024</time>
                </div>
              </div><!-- End recent post item-->

              <div class="post-item">
                <img src="assets/img/blog/blog-recent-1-1.jpg" alt="" class="flex-shrink-0">
                <div>
                  <h4><a href="blog-details.html">Gran Hotel Djibloho</a></h4>
                  <time datetime="2024-01-08">Enero 8, 2024</time>
                </div>
              </div><!-- End recent post item-->
            </div><!--/Recent Posts Widget -->
            
          </div>

        </div>

      </div>
    </div>
    </main>
  <?= $this->include('app/footer-portal') ?>

 