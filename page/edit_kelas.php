<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Data Kelas</h1>
      </div>
    </div>
  </div>
</div>

<?php
$id = $_GET['id'];
$edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM tabel_kelas WHERE Id_kelas='$id' "));

if(isset($_POST['tambah'])){
  $id_kelas = $_POST['id_kelas'];
  $nm_kelas = $_POST['nm_kelas'];

  $update = mysqli_query($koneksi,"UPDATE tabel_kelas SET Nm_kelas='$nm_kelas' WHERE Id_kelas='$id_kelas' ");

  if ($update) {
    echo '<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      Berhasil Disimpan</div>';
    echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
  }else{
    echo '<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      Gagal Disimpan</div>';
  }
}
?>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body p-2">
        <form method="POST" action="">
          <div class="form-group">
            <label>Id Kelas</label>
            <input type="number" name="id_kelas" value="<?=$edit['Id_kelas']; ?>" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label>Nama Kelas</label>
            <input type="text" name="nm_kelas" value="<?=$edit['Nm_kelas']; ?>" class="form-control" required>
          </div>
          <div class="card-footer">
            <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>