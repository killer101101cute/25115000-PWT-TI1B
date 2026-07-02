<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Data Guru</h1>
      </div>
    </div>
  </div>
</div>

<?php
$kd = $_GET['kd'];
$edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM tabel_guru WHERE Kd_guru='$kd' "));

if(isset($_POST['tambah'])){
  $kd_guru = $_POST['kd_guru'];
  $nm_guru = $_POST['nm_guru'];

  $update = mysqli_query($koneksi,"UPDATE tabel_guru SET Nm_guru='$nm_guru' WHERE Kd_guru='$kd_guru' ");

  if ($update) {
    echo '<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-info"></i> Info </h5>
      Berhasil Disimpan
    </div>';
    echo '<meta http-equiv="refresh" content="1;url=index.php?page=guru">';
  }else{
    echo '<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-info"></i> Info </h5>
      Gagal Disimpan
    </div>';
  }
}
?>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <div class="card-body p-2">
          <form method="POST" action="">
            <div class="form-group">
              <label for="kd_guru">Kode Guru</label>
              <input type="text" name="kd_guru" value="<?=$edit['Kd_guru']; ?>" class="form-control" readonly>
            </div>

            <div class="form-group">
              <label for="nm_guru">Nama Guru</label>
              <input type="text" name="nm_guru" value="<?=$edit['Nm_guru']; ?>" id="nm_guru" placeholder="Nama Guru" class="form-control" required>
            </div>

            <div class="card-footer">
              <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>