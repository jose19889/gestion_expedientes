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
</div>
</div>
</div>

<section class="content">
<div class="container-fluid">

<?= $this->include('app/alerts') ?>

<div class="row">

<!-- 🔵 TABLA -->
<section class="col-lg-7">
<div class="card">
<div class="card-header">
<h3>Últimos Expedientes</h3>
</div>

<div class="card-body">

<table class="table table-bordered table-striped">
<thead>
<tr>
<th>#</th>
<th>Asunto</th>
<th>Tipo</th>
</tr>
</thead>

<tbody>
<?php $n = 0; ?>
<?php foreach ($expedientes as $exp): ?>
<tr>
<td><?= ++$n ?></td>
<td><?= esc($exp['titulo']) ?></td>
<td><?= esc($exp['tipo']) ?></td>
</tr>
<?php endforeach; ?>
</tbody>

</table>

</div>
</div>
</section>

<!-- 🔴 GRAFICA -->
<section class="col-lg-5">
<div class="card">

<div class="card-header">
<h3>Balance de Expedientes</h3>
</div>

<div class="card-body">
<canvas id="denunciaChart"></canvas>
</div>

</div>
</section>

</div>

</div>
</section>

</div>
</section>

<!-- ✅ CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const labels = <?= $labels ?? '[]' ?>;
    const data = <?= $data ?? '[]' ?>;

    console.log(labels, data);

    const canvas = document.getElementById('denunciaChart');

    if (!canvas || data.length === 0) {
        console.warn("Sin datos para gráfica");
        return;
    }

    const ctx = canvas.getContext('2d');

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: [
                    '#6c757d',
                    '#17a2b8',
                    '#ffc107',
                    '#28a745',
                    '#dc3545',
                    '#343a40'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

});
</script>

<?= $this->include('app/footer') ?>