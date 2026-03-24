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
              <li class="breadcrumb-item active">Dashboard v1 </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
       <? // = $this->include('app/shortcut') ?>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
          <?= $this->include('app/alerts') ?>
        <!-- Small boxes (Stat box) -->
        <div class="row">
         
          <!-- ./col -->
         
          <!-- ./col -->
         
          <!-- ./col -->
         
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">

            <!-- Map card -->
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Ultimas 10 Expediemntes de Anticorruocion
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                    <i class="far fa-calendar-alt"></i>
                  </button>
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>



                </div>
                <!-- /.card-tools -->
              </div>
           
            
            </div>
       <table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>

          <?php   $n = 0;?>
           <th>id</th>
            
            <th>Asunto</th>
             <th>Tipo denuccia</th>
         
        </tr>
    </thead>
    <tbody>
        <?php /*

        // Assuming $emails is already populated with data
        $emails = array_slice($emails, 0, 4); // Limit to 10 records
        foreach ($emails as $email):
        ?>
            <tr> 
                <td><?php echo ++$n; ?></td>
                <td><?php echo $email['your_subject']; ?></td>
                <td><?php echo $email['tipo_denuncia']; ?></td>
            </tr>
        <?php endforeach;  */?>
    </tbody>
    <tfoot>
        <tr>
            <th>id</th>
            <th>Asunto</th>
             <th>Tipo denuccia</th>
         
        </tr>
    </tfoot>
</table>
      
            <!-- /.card -->
          </section>
          <!-- right col -->

<section class="col-lg-5 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Balance de Expediemntes
                </h3>
                <br><br>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">10 Ultimas Expediemntes  </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Estadistica por tipo de Expediemntes</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart">
                       <!-- Canvas for Chart.js -->
  <canvas id="denunciaChart" width="400" height="200"></canvas>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      // Get the data passed from the controller
      const labels = <?= $labels ?>; // This will be an array of tipo_denuncia labels (e.g., ['Fraude', 'Robo', 'Violencia'])
      const data = <?= $data ?>;     // This will be an array of counts (e.g., [10, 5, 7])
      
      // You may have another array with the type names (if not, use the `labels` array for that)
      const tipoExpediemntes = <?= $labels ?>; // This should be an array like ['Fraude', 'Robo', 'Violencia']

      // Create a bar chart
      const ctx = document.getElementById('denunciaChart').getContext('2d');
      const denunciaChart = new Chart(ctx, {
          type: 'bar', // You can change this to 'pie', 'line', etc.
          data: {
              labels: labels, // Labels for each bar
              datasets: [{
                  label: 'Count of Expediemntes by Tipo',
                  data: data, // Values for each label (count of Expediemntes)
                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                  borderColor: 'rgba(54, 162, 235, 1)',
                  borderWidth: 1
              }]
          },
          options: {
              scales: {
                  y: {
                      beginAtZero: true
                  }
              },
              responsive: true,
              plugins: {
                  legend: {
                      position: 'top',
                  },
                  tooltip: {
                      callbacks: {
                          label: function(tooltipItem) {
                              // Get the index of the tooltip item
                              const index = tooltipItem.dataIndex;
                              const count = tooltipItem.raw; // Count of Expediemntes
                              const tipo = tipoExpediemntes[index]; // Corresponding tipo_denuncia
                              return `${tipo}: ${count} Expediemntes`; // Show both type and count
                          }
                      }
                  }
              }
          }
      });
</script>
                 </div>
                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                En construcc��on
                </div>
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->

           
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->



        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</section>
          
 
  <?= $this->include('app/footer') ?>
 