<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>APPLembur</title>
  <link rel="icon" type="image/png" href="adminlte/img/utlogo.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css"> -->

  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/adminlte/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="/adminlte/plugins/timepicker/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Header -->
  @include('layouts.header_index')
  <!-- Left side column. contains the logo and sidebar -->
  @include('layouts.menu_index')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color: rgb(187, 219, 249);">
    <!-- Content Header (Page header) -->
    <main class="py-4">
            @yield('content')
    </main>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('layouts.footer')

  <!-- Control Sidebar -->

  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/adminlte/js/demo.js"></script>
<!-- DataTables -->
<script src="/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script> -->
<!-- SlimScroll -->
<script src="/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="/adminlte/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="/adminlte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="/adminlte/plugins/timepicker/bootstrap-timepicker.min.js"></script>

  <script>
    $(document).ready(function () {
                  $('#tanggal').datepicker({
                      format: "dd-mm-yyyy",
                      autoclose: true
                  });
                  $('#tanggal2').datepicker({
                      format: "dd-mm-yyyy",
                      autoclose: true
                  });
              });
  </script>
  
  <script type="text/javascript">
          $(document).ready(function() {
              $('#example1').DataTable( {
                  dom: 'Bfrtip',
                  buttons: [
                      'excel', 'print'
                  ]
              } );
          } );
      </script>


  <script>
        $(function(){
            $(document).on('click','.upload',function(e){
                e.preventDefault();
                $("#uploadMahasiswa").modal('show');
            });
        });
    
  </script>

  <script>
    $('#myModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var id = button.data('lemburid')
      var namapegawai = button.data('myname')
      var nip = button.data('nip')
      var nip_atasan = button.data('nipatasan')
      var tgl_lembur = button.data('tgllembur')
      var masuk = button.data('masuk')
      var pulang = button.data('pulang')
      var kegiatan = button.data('kegiatan')
      var uraiankegiatan = button.data('uraiankegiatan')
      var volume = button.data('volume')
      var satuan = button.data('satuan')
      var kode_upbjj = button.data('kodeupbjj')
      var user_id = button.data('userid')
      var modal = $(this)

      modal.find('.modal-body #id').val(id);
      modal.find('.modal-body #myname').val(namapegawai);
      modal.find('.modal-body #nip').val(nip);
      modal.find('.modal-body #nipatasan').val(nip_atasan);
      modal.find('.modal-body #tgllembur').val(tgl_lembur);
      modal.find('.modal-body #masuk').val(masuk);
      modal.find('.modal-body #pulang').val(pulang);
      modal.find('.modal-body #kegiatan').val(kegiatan);
      modal.find('.modal-body #uraiankegiatan').val(uraiankegiatan);
      modal.find('.modal-body #volume').val(volume);
      modal.find('.modal-body #satuan').val(satuan);
      modal.find('.modal-body #kodeupbjj').val(kode_upbjj);
      modal.find('.modal-body #userid').val(user_id);      
    })
  </script>

</body>
</html>
