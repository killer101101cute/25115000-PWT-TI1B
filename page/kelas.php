<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Kelas</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
  $id = $_GET['id'];
  mysqli_query($koneksi, "DELETE FROM tabel_kelas WHERE Id_kelas = '$id'");
  echo '<div class="alert alert-warning alert-dismissible">Berhasil Dihapus</div>';
  echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
}
?>

<div class="content">
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <a href="index.php?page=tambah_kelas" class="btn btn-primary btn-sm mb-2">Tambah Kelas</a>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>NO</th>
            <th>Id Kelas</th>
            <th>Nama Kelas</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $no = 0;
        $query = mysqli_query($koneksi, "SELECT * FROM tabel_kelas");
        if (!$query) {
          echo "<tr><td colspan='4' class='text-danger'>Error: " . mysqli_error($koneksi) . "</td></tr>";
        } else {
          while ($data = mysqli_fetch_array($query)) {
            $no++;
        ?>
          <tr>
            <td><?= $no; ?></td>
            <td><?= $data['Id_kelas']; ?></td>
            <td><?= $data['Nm_kelas']; ?></td>
            <td>
              <a href="index.php?page=kelas&action=hapus&id=<?= $data['Id_kelas']; ?>" class="badge badge-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
              <a href="index.php?page=edit_kelas&id=<?= $data['Id_kelas']; ?>" class="badge badge-warning">Edit</a>
            </td>
          </tr>
        <?php } } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>