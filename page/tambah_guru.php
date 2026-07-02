<?php
require_once "config/koneksi.php";

if(isset($_POST['simpan'])){
    $kd_guru = trim($_POST['kd_guru']);
    $nm_guru = trim($_POST['nm_guru']);
    $jenkel = trim($_POST['jenkel']);
    $pend = trim($_POST['pend']);
    $hp = trim($_POST['hp']);
    $alamat = trim($_POST['alamat']);
    $pass = md5(trim($_POST['pass'])); // Enkripsi sandi

    $simpan = mysqli_query($koneksi, "INSERT INTO tabel_guru 
    (Kd_guru, Nm_guru, Jenkel, Pend_terakhir, Hp, Alamat, Password) 
    VALUES ('$kd_guru', '$nm_guru', '$jenkel', '$pend', '$hp', '$alamat', '$pass')");

    if($simpan){
        echo '<script>alert("Data Guru Berhasil Ditambahkan!"); window.location="index.php?page=guru";</script>';
    }else{
        echo '<div class="alert alert-danger">Gagal: '.mysqli_error($koneksi).'</div>';
    }
}
?>

<div class="content-header">
  <div class="container-fluid">
    <h1>Tambah Data Guru</h1>
  </div>
</div>

<div class="content">
<div class="container-fluid">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label>Kode Guru</label>
            <input type="text" name="kd_guru" class="form-control" value="G-003" readonly required>
          </div>
          <div class="form-group">
            <label>Nama Lengkap Guru</label>
            <input type="text" name="nm_guru" class="form-control" placeholder="Masukkan Nama" required>
          </div>
          <div class="form-group">
            <label>Jenis Kelamin</label>
            <select name="jenkel" class="form-control" required>
              <option value="">-- Pilih --</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label>Pendidikan Terakhir</label>
            <input type="text" name="pend" class="form-control" placeholder="Contoh: S1 Pendidikan" required>
          </div>
          <div class="form-group">
            <label>Nomor HP</label>
            <input type="text" name="hp" class="form-control" placeholder="08xxxxxxxxx" required>
          </div>
          <div class="form-group">
            <label>Alamat Lengkap</label>
            <textarea name="alamat" class="form-control" rows="3" required></textarea>
          </div>
          <div class="form-group">
            <label>Kata Sandi Awal</label>
            <input type="password" name="pass" class="form-control" placeholder="Buat sandi login" required>
          </div>
          <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
          <a href="index.php?page=guru" class="btn btn-secondary">Kembali</a>
        </form>
      </div>
    </div>
  </div>
</div>
</div>