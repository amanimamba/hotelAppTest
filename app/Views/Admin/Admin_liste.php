
<?= view('Menu/Header.php')?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Hotel </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <?=$link_btn?>
             
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
         <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12"style="overflow:scroll;">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><strong><?=$titre?></strong> </h3>
               
              </div>
                <div >
          <center>
            <?php
            $session= \Config\Services::session();
            if ($session->getFlashData('Type')=='erreur') 
            {
              echo '<p class="text text-danger" style="font-size: 25px;font-weight: 800;">
              '.$session->getFlashData('Message').'</p>';// code...
            }else if ($session->getFlashData('Type')=='success') {
              echo '<p class="text text-success" style="font-size: 25px;font-weight: 800;">
              '.$session->getFlashData('Message').'</p>';
            }

                       
            ?>
          
          </center>
        </div>
              <!-- /.card-header -->
              <div class="card-body" >
                
                 <?=$liste?>
                  
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
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
  <?= view('Menu/Footer.php')?>

  