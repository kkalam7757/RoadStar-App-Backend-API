<!-- jQuery 3 -->
<script src="{{ asset('admin') }}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="{{ asset('admin') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="{{ asset('admin') }}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('admin') }}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="{{ asset('admin') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('admin') }}/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin') }}/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin') }}/dist/js/demo.js"></script>
<script src="{{ asset('admin') }}/dist/js/csrf.js"></script>
<script src="{{ asset('admin') }}/dist/js/sweetalert.min.js"></script>
<script src="{{ asset('admin') }}/dist/js/toastr.min.js"></script>
<script src="{{ asset('admin') }}/dist/js/validations.js"></script>
<script src="{{ asset('admin') }}/dist/js/active_deactive.js"></script>
<script src="{{ asset('admin') }}/dist/js/main_image.js"></script>
<script src="{{ asset('admin') }}/dist/js/modal.js"></script>
<script src="{{ asset('admin') }}/dist/js/image_preview.js"></script>
<script src="{{ asset('admin') }}/dist/js/active_sidebar.js"></script>
<script src="{{ asset('admin') }}/dist/js/form_validate.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>