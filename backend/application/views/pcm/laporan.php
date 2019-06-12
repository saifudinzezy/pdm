<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url().'assets/img/apple-icon.png'; ?>">
    <link rel="icon" type="image/png" href="<?php echo base_url().'assets/img/favicon.png'; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        Cetak Laporan Tahunan
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="<?php echo base_url().'assets/css/material-dashboard.css?v=2.1.1'; ?>" rel="stylesheet"/>
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo base_url().'assets/demo/demo.css'; ?>" rel="stylesheet"/>
    <!-- datatable -->
    <!-- data tabel -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/datatable/datatables.css' ?>">
    <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/datatable/jquery.dataTables.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/datatable/datatables.js' ?>"></script>
</head>

<body class="">

      <div class="content">
        <div class="container-fluid">
            <br><br><br>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header card-header-warning text-center">
                  <h2 class="card-title"><b>PDM</b></h2>
                  <h2 class="card-title"><b>Kab. Pekalongan</b></h2>
                  <p class="card-category"><b>Cetak Laporan Tahunan</b></p>
                </div>
                <div class="card-body">
                  <form method="post" action="<?php echo base_url().'pcm' ?>">
                    <br>
                    <?php 
                      //cek ada kiriman data
                      if (isset($_GET['pesan'])) {
                        //cek apakah pesan == gagal
                        if ($_GET['pesan'] == 'gagal') {                         
                          echo "<div class='alert alert-danger'>
                                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='material-icons'>close</i>
                                  </button>
                                  <span>
                                    Login gagal! Username dan Password salah.
                                  </span>
                                </div>";
                        //jika logout
                        }elseif ($_GET['pesan'] == 'logout') {
                          echo "<div class='alert alert-danger'>
                                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='material-icons'>close</i>
                                  </button>
                                  <span>
                                    Anda telah logout!
                                  </span>
                                </div>";
                        //jika belum login
                        }elseif ($_GET['pesan'] == 'belumlogin') {
                           echo "<div class='alert alert-success'>
                                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <i class='material-icons'>close</i>
                                  </button>
                                  <span>
                                    Silahkan login dulu
                                  </span>
                                </div>";
                        }
                      }
                    ?>                     
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Kode Daftar</label>
                          <input type="text" class="form-control" name="kode">
                          <!-- tampilkan pesan error jika tidak di isi-->
                          <?php echo form_error('kode'); ?>
                        </div>
                      </div>                      
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tahun</label>
                          <input type="text" class="form-control" name="tahun">
                          <!-- tampilkan pesan error jika tidak di isi-->
                          <?php echo form_error('tahun'); ?>
                        </div>
                      </div>                      
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-primary pull-right">Cetak</button>
                        </div>
                    </div>
                    </div>                    
                    <div class="clearfix"></div>
                    <br>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4"></div>    
            </div>
          </div>
        </div>

</div>
</div>
<!--   Core JS Files   -->
<script src="<?php echo base_url().'assets/js/core/jquery.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/core/popper.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/core/bootstrap-material-design.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/plugins/perfect-scrollbar.jquery.min.js'; ?>"></script>
<!-- Plugin for the momentJs  -->
<script src="<?php echo base_url().'assets/js/plugins/moment.min.js'; ?>"></script>
<!--  Plugin for Sweet Alert -->
<script src="<?php echo base_url().'assets/js/plugins/sweetalert2.js'; ?>"></script>
<!-- Forms Validations Plugin -->
<script src="<?php echo base_url().'assets/js/plugins/jquery.validate.min.js'; ?>"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script src="<?php echo base_url().'assets/js/plugins/jquery.bootstrap-wizard.js'; ?>"></script>
<!--  Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="<?php echo base_url().'assets/js/plugins/bootstrap-selectpicker.js'; ?>"></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="<?php echo base_url().'assets/js/plugins/bootstrap-datetimepicker.min.js'; ?>"></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="<?php echo base_url().'assets/js/plugins/jquery.dataTables.min.js'; ?>"></script>
<!--  Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="<?php echo base_url().'assets/js/plugins/bootstrap-tagsinput.js'; ?>"></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script src="<?php echo base_url().'assets/js/plugins/jasny-bootstrap.min.js'; ?>"></script>
<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
<script src="<?php echo base_url().'assets/js/plugins/fullcalendar.min.js'; ?>"></script>
<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
<script src="<?php echo base_url().'assets/js/plugins/jquery-jvectormap.js'; ?>"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="<?php echo base_url().'assets/js/plugins/nouislider.min.js'; ?>"></script>
<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<!-- Library for adding dinamically elements -->
<script src="<?php echo base_url().'assets/js/plugins/arrive.min.js'; ?>"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Chartist JS -->
<script src="<?php echo base_url().'assets/js/plugins/chartist.min.js' ?>"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url().'assets/js/plugins/bootstrap-notify.js'; ?>"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?php echo base_url().'assets/js/material-dashboard.js?v=2.1.1' ?>" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url().'assets/demo/demo.js'; ?>"></script>
<script>
    $(document).ready(function () {
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#table-datatable").dataTable();
    });
</script>
</body>
</html>