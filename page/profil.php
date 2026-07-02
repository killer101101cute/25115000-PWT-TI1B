<?php
require_once "config/koneksi.php";
// session_start(); 👉 HAPUS BARIS INI!
$user = $_SESSION['username'];
$role = $_SESSION['role'];
$nama = "-";
$dt = [];

if($role == 'admin'){
    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE Username='$user'");
    $dt = mysqli_fetch_array($cek);
    $nama = 'Administrator';
}elseif($role == 'guru'){
    $cek = mysqli_query($koneksi, "SELECT * FROM tabel_guru WHERE Kd_guru='$user'");
    $dt = mysqli_fetch_array($cek);
    $nama = $dt['Nm_guru'] ?? '-';
}else{
    // Siswa: Pastikan nama kolom sesuai tabelmu!
    $cek = mysqli_query($koneksi, "SELECT * FROM tabel_siswa WHERE Nis='$user'");
    $dt = mysqli_fetch_array($cek);
    $nama = $dt['Nm_siswa'] ?? '-';
}
?>

<div class="content-header">
  <div class="container-fluid">
    <h1>Profil Pengguna</h1>
  </div>
</div>

<div class="content">
<div class="container-fluid">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <table class="table table-borderless">
          <tr>
            <td width="40%">Username / Kode Identitas</td>
            <td>: <?=$user;?></td>
          </tr>
          <tr>
            <td>Nama Lengkap</td>
            <td>: <?=$nama;?></td>
          </tr>
          <tr>
            <td>Hak Akses</td>
            <td>: <?=ucfirst($role);?></td>
          </tr>

          <?php if($role == 'guru' && !empty($dt)): ?>
          <tr>
            <td>Jenis Kelamin</td>
            <td>: <?=$dt['Jenkel'] ?? '-';?></td>
          </tr>
          <tr>
            <td>Pendidikan Terakhir</td>
            <td>: <?=$dt['Pend_terakhir'] ?? '-';?></td>
          </tr>
          <?php endif; ?>

          <?php if($role == 'siswa' && !empty($dt)): ?>
          <tr>
            <td>Kelas</td>
            <td>: <?=$dt['Id_kelas'] ?? '-';?></td>
          </tr>
          <?php endif; ?>
        </table>
        <a href="index.php?page=ubah_sandi" class="btn btn-primary mt-3">Ubah Kata Sandi</a>
      </div>
    </div>
  </div>
</div>
</div>