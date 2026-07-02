<?php
session_start();
require_once("config/koneksi.php");
if (isset($_SESSION['username'])) {
?>
  <!DOCTYPE html>
  <!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
  <html lang="id">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Sekolah</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Kontak</a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
              <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
              <form class="form-inline">
                <div class="input-group input-group-sm">
                  <input class="form-control form-control-navbar" type="search" placeholder="Cari..." aria-label="Search">
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
          <img src="dist/img/AdminLTELogo.png" alt="Logo Sistem" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Sistem Sekolah</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="Foto Pengguna">
            </div>
            <div class="info">
              <a href="#" class="d-block"><?= $_SESSION['nama_lengkap'] ?? 'Pengguna' ?></a>
            </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Cari Menu..." aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              
              <?php if ($_SESSION['role'] == 'admin') { ?>
                <!-- Menu Admin -->
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-database"></i>
                    <p>
                      MASTER DATA
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="index.php?page=guru" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Guru</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="index.php?page=siswa" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Siswa</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="index.php?page=kelas" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kelas</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="index.php?page=ekstrakurikuler" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ekstrakurikuler</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="index.php?page=mapel" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Mata Pelajaran</p>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>
                      TRANSAKSI
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <!-- ✅ Menu Jadwal yang sudah ditambahkan -->
                    <li class="nav-item">
                      <a href="index.php?page=jadwal" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Jadwal Pelajaran</p>
                      </a>
                    </li>
                  </ul>
                </li>
              <?php } ?>

              <?php if ($_SESSION['role'] == 'guru') { ?>
                <!-- Menu Guru -->
                <li class="nav-item">
                  <a href="index.php?page=profil" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Profil</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="index.php?page=kelas" class="nav-link">
                    <i class="nav-icon fas fa-chalkboard"></i>
                    <p>Kelas</p>
                  </a>
                </li>
                <!-- ✅ Menu Jadwal untuk Guru -->
                <li class="nav-item">
                  <a href="index.php?page=jadwal" class="nav-link">
                    <i class="nav-icon fas fa-calendar-check"></i>
                    <p>Jadwal Mengajar</p>
                  </a>
                </li>
              <?php } ?>

              <?php if ($_SESSION['role'] == 'siswa') { ?>
                <!-- Menu Siswa -->
                <li class="nav-item">
                  <a href="index.php?page=profil" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Profil</p>
                  </a>
                </li>
                <!-- ✅ Menu Jadwal untuk Siswa -->
                <li class="nav-item">
                  <a href="index.php?page=jadwal" class="nav-link">
                    <i class="nav-icon fas fa-calendar"></i>
                    <p>Jadwal Pelajaran</p>
                  </a>
                </li>
              <?php } ?>

              <!-- Menu Logout -->
              <li class="nav-item">
                <a href="logout.php" class="nav-link text-danger">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>Keluar</p>
                </a>
              </li>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper -->
      <div class="content-wrapper">
        <!-- Content Header -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Beranda</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                  <li class="breadcrumb-item active">
                    <?php 
                      if(isset($_GET['page'])){
                        echo ucwords(str_replace('_', ' ', $_GET['page']));
                      } else {
                        echo 'Dashboard';
                      }
                    ?>
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <?php
                    if (isset($_GET['page'])) {
                      $page = $_GET['page'];
                    } else {
                      $page = "dashboard";
                    }

                    // Cek keberadaan file
                    if (!file_exists("page/$page.php")) {
                      echo "<div class='alert alert-danger'>
                              <h5><i class='icon fas fa-exclamation-triangle'></i> Halaman tidak ditemukan!</h5>
                              File <b>page/$page.php</b> tidak tersedia.
                            </div>";
                    } else {
                      include "page/$page.php";
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
          <h5>Informasi</h5>
          <p>Pengaturan tambahan</p>
        </div>
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">
          Versi 1.0
        </div>
        <strong>Copyright &copy; 2026 <a href="#">Sistem Informasi Sekolah</a>.</strong> All rights reserved.
      </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
  </body>
  </html>
<?php
} else {
  echo "<meta http-equiv='refresh' content='0; url=login.php'>";
}
?>