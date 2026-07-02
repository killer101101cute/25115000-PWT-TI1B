<?php
require_once "config/koneksi.php";
$id = $_GET['id'];

$sql = "SELECT jk.*, k.Nm_kelas, m.Nm_mapel, g.Nm_guru, dj.Hari, dj.Jam_mulai, dj.Jam_selesai
        FROM tabel_jadwal_kelas jk
        JOIN tabel_detail_jadwal dj ON jk.Id_jadwal = dj.Id_jadwal
        JOIN tabel_kelas k ON jk.Id_kelas = k.Id_kelas
        JOIN tabel_mapel m ON dj.Kd_mapel = m.Kd_mapel
        JOIN tabel_guru g ON dj.Kd_guru = g.Kd_guru
        WHERE jk.Id_jadwal = '$id'";
$query = mysqli_query($koneksi, $sql);
$jdl = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Cetak Jadwal Kelas <?=$jdl['Nm_kelas'];?></title>
  <style>
    body { font-family: Arial, sans-serif; padding: 30px; }
    h2 { text-align: center; margin-bottom: 20px; }
    .tombol { margin-bottom: 15px; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #000; padding: 10px; text-align: center; }
    th { background-color: #f0f0f0; }
    @media print {
      .tombol { display: none; }
    }
  </style>
</head>
<body>

  <div class="tombol">
    <button onclick="window.print()" style="padding: 8px 15px; cursor: pointer;">🖨️ Klik di Sini untuk Mencetak</button>
  </div>

  <h2>JADWAL PELAJARAN KELAS <?=$jdl['Nm_kelas'];?><br>
  Tahun Ajaran <?=$jdl['Thn_ajaran'];?> | Semester <?=$jdl['Semester'];?></h2>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Mata Pelajaran</th>
        <th>Guru Pengampu</th>
        <th>Hari</th>
        <th>Jam Pelajaran</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      mysqli_data_seek($query, 0);
      while($data = mysqli_fetch_array($query)){
      ?>
      <tr>
        <td><?=$no++;?></td>
        <td><?=$data['Nm_mapel'];?></td>
        <td><?=$data['Nm_guru'];?></td>
        <td><?=$data['Hari'];?></td>
        <td><?=substr($data['Jam_mulai'],0,5).' - '.substr($data['Jam_selesai'],0,5);?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

</body>
</html>