<!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?=date('Y')?> <a href="">HopeTechnologies.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
     
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?=base_url()?>/public/plugins/jquery/jquery.min.js"></script>
<script src="<?=base_url()?>/public/sweetalert.js"></script>
<script >
  swal({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
   function get_delete(donner){
     let urldata=donner.id;
    let Conf=confirm('Vous etez sur de vouloir supprimer');
    if (Conf) {
       $.ajax({
      url:urldata,
      method:'GET',
      success:function(dt){
        open(dt,'_self');
      }
      })
    }
   }
</script>
<!-- Bootstrap -->
<script src="<?=base_url()?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=base_url()?>/public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?=base_url()?>/public/plugins/jquery-mousewheel/jquery.mousewheel.js" ></script>
<script src="<?=base_url()?>/public/plugins/raphael/raphael.min.js"></script>
<script src="<?=base_url()?>/public/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?=base_url()?>/public/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?=base_url()?>/public/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?=base_url()?>/public/dist/js/pages/dashboard2.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="<?=base_url()?>/public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>/public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>/public/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>/public/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>

</body>
</html>
