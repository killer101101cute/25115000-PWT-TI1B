<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Jadwal Pelajaran</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM tabel_jadwal_kelas WHERE Id_jadwal = '$id'");
    echo '<div class="alert alert-success">Jadwal berhasil dihapus</div>';
}
?>

<div class="content">
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm mb-2">➕ Tambah Jadwal</a>
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Guru</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Tahun / Semester</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        // ✅ SEMUA nama tabel SESUAI DENGAN DATABASE KAMU
        $sql = "SELECT jk.Id_jadwal, jk.Id_kelas, jk.Thn_ajaran, jk.Semester,
                       k.Nm_kelas, m.Nm_mapel, g.Nm_guru,
                       dj.Hari, dj.Jam_mulai, dj.Jam_selesai
                FROM tabel_jadwal_kelas jk
                INNER JOIN tabel_detail_jadwal dj ON jk.Id_jadwal = dj.Id_jadwal
                INNER JOIN tabel_kelas k ON jk.Id_kelas = k.Id_kelas
                INNER JOIN tabel_mapel m ON dj.Kd_mapel = m.Kd_mapel
                INNER JOIN tabel_guru g ON dj.Kd_guru = g.Kd_guru
                ORDER BY k.Nm_kelas, dj.Hari, dj.Jam_mulai";
        
        $query = mysqli_query($koneksi, $sql);
        
        if (!$query) {
            echo "<tr><td colspan='8' class='text-danger'>Error: " . mysqli_error($koneksi) . "</td></tr>";
        } else {
            while($data = mysqli_fetch_array($query)){
        ?>
          <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['Nm_kelas']; ?></td>
            <td><?= $data['Nm_mapel']; ?></td>
            <td><?= $data['Nm_guru']; ?></td>
            <td><?= $data['Hari']; ?></td>
            <td><?= substr($data['Jam_mulai'],0,5).' - '.substr($data['Jam_selesai'],0,5); ?></td>
            <td><?= $data['Thn_ajaran'].' / '.$data['Semester']; ?></td>
            <td>
              <a href="cetak_jadwal.php?id=<?= $data['Id_jadwal']; ?>" target="_blank" class="badge badge-info">Cetak</a>
              <a href="index.php?page=jadwal&hapus=<?= $data['Id_jadwal']; ?>" class="badge badge-danger" onclick="return confirm('Yakin hapus semua jadwal kelas ini?')">Hapus</a>
            </td>
          </tr>
        <?php } } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>