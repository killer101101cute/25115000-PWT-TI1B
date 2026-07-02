<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Data Siswa</h1>
      </div>
    </div>
  </div>
</div>

<?php
$nis = $_GET['nis'];
$edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM tabel_siswa WHERE Nis='$nis' "));

if(isset($_POST['tambah'])){
  $nis_baru = $_POST['nis'];
  $nm_siswa = $_POST['nm_siswa'];
  $jenkel = $_POST['jenkel'];
  $hp = $_POST['hp'];
  $id_kelas = $_POST['id_kelas'];

  $update = mysqli_query($koneksi,"UPDATE tabel_siswa SET Nm_siswa='$nm_siswa', Jenkel='$jenkel', Hp='$hp', Id_kelas='$id_kelas' WHERE Nis='$nis_baru' ");

  if ($update) {
    echo '<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-info"></i> Info </h5>
      Berhasil Disimpan
    </div>';
    echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';
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
      <div class="card-body p-2">
        <form method="POST" action="">
          <div class="form-group">
            <label for="nis">NIS</label>
            <input type="text" name="nis" value="<?=$edit['Nis']; ?>" class="form-control" readonly>
          </div>

          <div class="form-group">
            <label for="nm_siswa">Nama Siswa</label>
            <input type="text" name="nm_siswa" value="<?=$edit['Nm_siswa']; ?>" id="nm_siswa" placeholder="Nama Siswa" class="form-control" required>
          </div>

          <div class="form-group">
            <label for="jenkel">Jenis Kelamin</label>
            <select name="jenkel" class="form-control">
              <option value="Laki-laki" <?php if($edit['Jenkel']=="Laki-laki") echo "selected"; ?>>Laki-laki</option>
              <option value="Perempuan" <?php if($edit['Jenkel']=="Perempuan") echo "selected"; ?>>Perempuan</option>
            </select>
          </div>

          <div class="form-group">
            <label for="hp">No HP</label>
            <input type="text" name="hp" value="<?=$edit['Hp']; ?>" id="hp" placeholder="No HP" class="form-control">
          </div>

          <div class="form-group">
            <label for="id_kelas">Kelas</label>
            <input type="text" name="id_kelas" value="<?=$edit['Id_kelas']; ?>" id="id_kelas" placeholder="Contoh: 1, 2" class="form-control">
          </div>

          <div class="card-footer">
            <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
          </div>
        </form>
      </div>
    </div>
  </div>
</section>