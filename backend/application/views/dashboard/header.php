<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url().'assets/img/apple-icon.png'; ?>">
    <link rel="icon" type="image/png" href="<?php echo base_url().'assets/img/favicon.png'; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        PDMPKL | Dashboard
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
<div class="wrapper ">
    <div class="sidebar" data-color="orange" data-background-color="white" data-image="<?php echo base_url().'assets/img/sidebar-1.jpg'; ?>">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo">
            <a href="<?php echo base_url().'admin'; ?>" class="simple-text logo-normal">
                PDM Pekalongan
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <?php 
                    if (isset($dash)) {
                        echo "<li class='nav-item active'>";
                    }else{
                        echo "<li class='nav-item'>";                        
                    }
                ?> 
                    <a class="nav-link" href=" <?php echo base_url().'admin'; ?> ">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>

                 <?php 
                    if (isset($user)) {
                        echo "<li class='nav-item active'>";
                    }else{
                        echo "<li class='nav-item'>";                        
                    }
                ?> 
                    <a class="nav-link" href=" <?php echo base_url().'user'; ?> ">
                        <i class="material-icons">person</i>
                        <p>Anggota PDM</p>
                    </a>
                </li>

                <?php 
                    if (isset($lap)) {
                        echo "<li class='nav-item active'>";
                    }else{
                        echo "<li class='nav-item'>";                        
                    }
                ?>                
                    <a class="nav-link" href=" <?php echo base_url().'laporan'; ?> ">
                    <i class="material-icons">content_paste</i>
                        <p>Laporan</p>
                    </a>
                </li>

               <?php 
                    if (isset($cetak)) {
                        echo "<li class='nav-item active'>";
                    }else{
                        echo "<li class='nav-item'>";                        
                    }
                ?>    
                    <a class="nav-link" href=" <?php echo base_url().'cetaklap'; ?> ">
                    <i class="material-icons">print</i>
                        <p>Cetak Laporan</p>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <a class="navbar-brand" href="#pablo">Dashboard</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">notifications</i>
                                <span class="notification">
                                    <?php                                         
                                        echo $this->m_crud->get_data_nol('laporan'); 
                                    ?>
                                </span>
                                <p class="d-lg-none d-md-block">
                                    Some Actions
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">                 
                                <?php 
                                    $data['lap'] = $this->m_crud->get_alldata_nol('laporan', 'laporan.id')->result();

                                    foreach ($data['lap'] as $d) {
                                 ?>
                                    <!-- <a class="dropdown-item" href="#"><?php echo $d->tanggal; ?></a> -->
                                    <a class="dropdown-item" href="<?php echo base_url().'laporan' ?>">
                                        <table>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><?php echo date("d/m/Y", strtotime($d->tanggal)); ?></td>
                                            </tr>
                                            <tr>
                                                <td><b><?php echo $d->nama; ?></b></td>
                                                <td> | </td>
                                                <td><b><?php echo $d->nama_asset; ?></b></td>
                                            </tr>
                                        </table>
                                    </a>
                                    <hr>
                                <?php } ?>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person</i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                                <a class="dropdown-item" href="<?php echo base_url().'admin/profile' ?>">Profile</a>
                                <a class="dropdown-item" href="<?php echo base_url().'admin/akun' ?>">Akun</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo base_url().'admin/logout'; ?>">Log out</a>
                            </div>
                        </li> 
                        <?php echo $this->session->userdata('nama')." ,  <b>  اَلسَّلَامُ عَلَيْكُمْ</b>"?> 
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->