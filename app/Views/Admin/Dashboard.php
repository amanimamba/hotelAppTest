<?= view('Menu/Header.php')?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Table de bord</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-bed"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Chambres</span>
                <span class="info-box-number">
                  <?=$Chambre ?>
                  <small></small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bed"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Chambres Occuper</span>
                <span class="info-box-number">
                <?=$location_chambres?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-th"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Categorie Chambres</span>
                <span class="info-box-number">
                  <?=$categorie_Chambre?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Clients</span>
                <span class="info-box-number">2000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->


        </div>
        <!-- /.row -->
        <!-- DEBUT DETAIL -->
         <!-- Info boxes -->
        <div class="row">
          <?=$CategoriCount ?>
         
          <div class="clearfix hidden-md-up"></div>

        </div>

        <!-- FIN DETAIL -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Chambres Louer</h5>

                
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                     <!--  <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong> -->
                    </p>

                    <div class="chart">
                      
              <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;">
                
              </canvas>
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Goal Completion</strong>
                    </p>

                    <div class="progress-group">
                      Add Products to Cart
                      <span class="float-right"><b>160</b>/200</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->

                    <div class="progress-group">
                      Complete Purchase
                      <span class="float-right"><b>310</b>/400</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      <span class="progress-text">Visit Premium Page</span>
                      <span class="float-right"><b>480</b>/800</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-success" style="width: 60%"></div>
                      </div>
                    </div>

                    <!-- /.progress-group -->
                    <div class="progress-group">
                      Send Inquiries
                      <span class="float-right"><b>250</b>/500</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                      </div>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
            <!--  -->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

       
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.5
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?=base_url()?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?=base_url()?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url()?>/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>/public/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?=base_url()?>/public/dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?=base_url()?>/public/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?=base_url()?>/public/plugins/raphael/raphael.min.js"></script>
<script src="<?=base_url()?>/public/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?=base_url()?>/public/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?=base_url()?>/public/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?=base_url()?>/public/dist/js/pages/dashboard2.js"></script>
<script type="text/javascript">
   //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = {
      labels: [
          'Chrome', 
          'IE',
          'FireFox', 
          'Safari', 
          'Opera', 
          'Navigator', 
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var pieOptions     = {
      legend: {
        display: false
      }
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions      
    })

  //-----------------
  //- END PIE CHART -
  //-----------------
</script>
</body>
</html>
