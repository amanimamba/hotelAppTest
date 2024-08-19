
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
         <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Formulaire</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" action="<?=$link?>" enctype="multipart/form-data">
                <div class="card-body">
        <?=$formulaire?>
        <br/>
                  <button type="submit" class="btn btn-warning btn-block">Modifier</button>
                
         </div>
              </form>
            
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

  