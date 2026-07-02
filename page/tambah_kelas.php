<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah Data Kelas</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_POST['tambah'])){
    // Ambil input angka saja
    $id_kelas = $_POST['id_kelas'];
    $nm_kelas = $_POST['nm_kelas'];

    // Kueri sesuai nama tabel dan kolom
    $insert = mysqli_query($koneksi,"INSERT INTO tabel_kelas (Id_kelas, Nm_kelas) VALUES ('$id_kelas','$nm_kelas')");
    
    if ($insert) {
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        Berhasil Disimpan</div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=kelas">';
    }else{
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>
        Gagal Disimpan: '.mysqli_error($koneksi).'</h4></div>';
    }
}
?>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body p-2">
        <form method="POST" action="">
          <div class="form-group">
            <label>Id Kelas (Hanya Angka, Contoh: 1 / 2 / 3)</label>
            <input type="number" name="id_kelas" class="form-control" placeholder="Masukkan angka saja" required>
          </div>
          <div class="form-group">
            <label>Nama Kelas</label>
            <input type="text" name="nm_kelas" class="form-control" placeholder="Contoh: X IPA 1 / XI IPS 2" required>
          </div>
          <div class="card-footer">
            <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>