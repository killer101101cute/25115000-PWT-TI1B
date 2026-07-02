<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Guru</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['action'])) {
  if($_GET['action'] == "hapus") {
    $kd = $_GET['kd'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM tabel_guru WHERE Kd_guru = '$kd'");
    if($query_hapus){
      echo '<div class="alert alert-warning alert-dismissible">Berhasil Dihapus</div>';
      echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
    }
  }
}
?>
<div class="content">
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <a href="index.php?page=tambah_guru" class="btn btn-primary btn-sm mb-2">
        Tambah Guru
      </a>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>Kode Guru</th>
            <th>Nama Guru</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <?php
        $no = 0;
        // ✅ Kueri pasti benar
        $query = mysqli_query($koneksi, "SELECT * FROM tabel_guru ORDER BY Kd_guru");
        
        // ✅ Tampilkan pesan error jika kueri gagal
        if (!$query) {
          echo "<tr><td colspan='4' class='text-danger'>Error Kueri: " . mysqli_error($koneksi) . "</td></tr>";
        } else {
          while ($result = mysqli_fetch_array($query) ) {
            $no++;
        ?>
        <tbody>
          <tr>
            <td><?= $no; ?></td>
            <td><?=$result['Kd_guru']; ?></td>
            <td><?=$result['Nm_guru']; ?></td>
            <td>
              <a href="index.php?page=guru&action=hapus&kd=<?= $result['Kd_guru'] ?>" onclick="return confirm('Yakin hapus?')">
                <span class="badge badge-danger">Hapus</span>
              </a>
              <a href="index.php?page=edit_guru&kd=<?= $result['Kd_guru'] ?>">
                <span class="badge badge-warning">Edit</span>
              </a>
            </td>
          </tr>
        </tbody>
        <?php } } ?>
      </table>
    </div>
  </div>
</div>
</div>