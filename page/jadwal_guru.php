<?php
require_once "config/koneksi.php";
session_start();
$kd_guru = $_SESSION['username']; // Asumsi session username menyimpan Kd_guru

// Tampil jadwal hanya milik guru yang login
$sql = "SELECT jk.Thn_ajaran, jk.Semester, k.Nm_kelas, m.Nm_mapel, dj.Hari, dj.Jam_mulai, dj.Jam_selesai
        FROM tabel_jadwal_kelas jk
        JOIN tabel_detail_jadwal dj ON jk.Id_jadwal = dj.Id_jadwal
        JOIN tabel_kelas k ON jk.Id_kelas = k.Id_kelas
        JOIN tabel_mapel m ON dj.Kd_mapel = m.Kd_mapel
        WHERE dj.Kd_guru = '$kd_guru'
        ORDER BY dj.Hari, dj.Jam_mulai";
$query = mysqli_query($koneksi, $sql);
?>

<div class="content-header">
  <div class="container-fluid">
    <h1>Jadwal Saya</h1>
  </div>
</div>

<div class="content">
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <a href="cetak_jadwal_guru.php" target="_blank" class="btn btn-info btn-sm mb-2">🖨️ Cetak Jadwal</a>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Tahun / Semester</th>
          </tr>
        </thead>
        <tbody>
        <?php $no=1; while($d=mysqli_fetch_array($query)){ ?>
          <tr>
            <td><?=$no++;?></td>
            <td><?=$d['Nm_kelas'];?></td>
            <td><?=$d['Nm_mapel'];?></td>
            <td><?=$d['Hari'];?></td>
            <td><?=substr($d['Jam_mulai'],0,5).' - '.substr($d['Jam_selesai'],0,5);?></td>
            <td><?=$d['Thn_ajaran'].' / '.$d['Semester'];?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>