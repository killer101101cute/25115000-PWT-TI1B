<?php
require_once "config/koneksi.php";
session_start();
$nis = $_SESSION['username']; // Asumsi session username menyimpan Nis siswa

// Ambil Id_kelas siswa yang login
$dt_siswa = mysqli_fetch_array(mysqli_query($koneksi, "SELECT Id_kelas FROM tabel_siswa WHERE Nis = '$nis'"));
$id_kelas_saya = $dt_siswa['Id_kelas'];

// Tampil jadwal hanya kelasnya
$sql = "SELECT jk.Thn_ajaran, jk.Semester, k.Nm_kelas, m.Nm_mapel, g.Nm_guru, dj.Hari, dj.Jam_mulai, dj.Jam_selesai
        FROM tabel_jadwal_kelas jk
        JOIN tabel_detail_jadwal dj ON jk.Id_jadwal = dj.Id_jadwal
        JOIN tabel_kelas k ON jk.Id_kelas = k.Id_kelas
        JOIN tabel_mapel m ON dj.Kd_mapel = m.Kd_mapel
        JOIN tabel_guru g ON dj.Kd_guru = g.Kd_guru
        WHERE jk.Id_kelas = '$id_kelas_saya'
        ORDER BY dj.Hari, dj.Jam_mulai";
$query = mysqli_query($koneksi, $sql);
?>

<div class="content-header">
  <div class="container-fluid">
    <h1>Jadwal Kelas Saya</h1>
  </div>
</div>

<div class="content">
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <a href="cetak_jadwal_siswa.php" target="_blank" class="btn btn-info btn-sm mb-2">🖨️ Cetak Jadwal</a>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Mata Pelajaran</th>
            <th>Guru</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Tahun / Semester</th>
          </tr>
        </thead>
        <tbody>
        <?php $no=1; while($d=mysqli_fetch_array($query)){ ?>
          <tr>
            <td><?=$no++;?></td>
            <td><?=$d['Nm_mapel'];?></td>
            <td><?=$d['Nm_guru'];?></td>
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