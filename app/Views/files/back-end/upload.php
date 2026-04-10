upload.php
<?= $this->extend('app/header') ?>
<?= $this->section('content') ?>
<div id="page-wrapper">
			<div class="main-page">
			
        	<div class="clearfix"> </div>
		</div>
		<br><br>
    <div class="col-md-12">
    <?= $this->include('app/alerts') ?>
    <div class="tables">
    <h1><?= $this->renderSection('listado de Denuncias') ?><h1>
    
    <h3 class="title1 "> Ventana de</h3> 
        <a href="reports-create"><i class=" btn btn-info fa fa-plus">   </i> Listado de Denuncias</a>
        <a href="reports-create"><i class=" btn btn-info fa fa-book">   </i> Generar Citaciones</a>
        <a href="reports-create"><i class=" btn btn-info fa fa-file">   </i> Exportar </a>
     <hr>
	

  <form action="<?= site_url('files-save') ?>" method="post" enctype="multipart/form-data">
        <label for="file">Choose a file:</label>
        <input type="file" name="file" id="file" required>
        <button type="submit">Upload</button>
    </form>
    
				</div>
    </div>

    <div class="clearfix"> </div>
		<script >
         new DataTable('#example')
    .on('order.dt', () => eventFired('Order'))
    .on('search.dt', () => eventFired('Search'))
    .on('page.dt', () => eventFired('Page'));
        </script>	
<?= $this->endSection() ?>