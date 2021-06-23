<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?=$title?></title>
    <!-- Custom fonts for this template-->
    <link href="<?=base_URL()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?=base_URL()?>assets/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?=base_URL()?>assets/css/user.css" rel="stylesheet">

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-white sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center " href="<?=base_url()?>home">
                <div class="sidebar-brand-text mx-3 text-dark">ArsipKu</div>
            </a>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item  <?php if($title=='Beranda'){echo 'active';}?>">
                <a class="nav-link text-dark" href="<?=base_url()?>home">
                    <i class="text-dark fas fa-fw fa-home"></i>
                    <span>Beranda</span></a>
            </li>
            <!-- Heading -->
            <div class="sidebar-heading">
                Jenis Arsip
            </div>
            <li class="nav-item <?php if($title=='Arsip pendidikan'){echo 'active';}?>">
                <a class="nav-link text-dark" href="<?=base_url()?>pendidikan">
                    <i class="text-dark fas fa-fw fa-graduation-cap"></i>
                    <span>Pendidikan</span></a>
            </li>
              <li class="nav-item <?php if($title=='Arsip keuangan'){echo 'active';}?>">
                <a class="nav-link text-dark" href="<?=base_url()?>keuangan">
                    <i class="text-dark fas fa-fw fa-hand-holding-usd"></i>
                    <span>Keuangan</span></a>
            </li>
              <li class="nav-item <?php if($title=='Arsip kesehatan'){echo 'active';}?>">
                <a class="nav-link text-dark" href="<?=base_url()?>kesehatan">
                    <i class="text-dark fas fa-fw fa-heartbeat"></i>
                    <span>Kesehatan</span></a>
            </li>
              <li class="nav-item <?php if($title=='Arsip kepemilikan'){echo 'active';}?>">
                <a class="nav-link text-dark" href="<?=base_url()?>kepemilikan">
                    <i class="text-dark fas fa-fw fa-building"></i>
                    <span>Kepemilikan</span></a>
            </li>
              <li class="nav-item <?php if($title=='Arsip Data Diri'){echo 'active';}?>">
                <a class="nav-link text-dark" href="<?=base_url()?>datadiri">
                    <i class="text-dark fas fa-fw fa-id-badge"></i>
                    <span>Data Diri</span></a>
            </li>
            <!-- Heading -->
            <div class="sidebar-heading">
                Profil
            </div>
             <li class="nav-item <?php if($title=='Pengaturan Profil'){echo 'active';}?>">
                <a class="nav-link text-dark" href="charts.html">
                    <i class="text-dark fas fa-fw fa-user-cog"></i>
                    <span>Pengaturan Profil</span></a>
            </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="<?=base_url()?>auth/logout">
                    <i class="text-dark fas fa-fw fa-sign-out-alt"></i>
                    <span>Keluar</span></a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-warning topbar mb-3 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none mr-2 bg-transparent">
                        <i class="fa fa-bars text-dark"></i>
                    </button>
                    <h5 class="text-dark title text-capitalize"><?=$title?></h5>
                </nav>
                <!-- End of Topbar -->