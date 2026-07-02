<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah Data Siswa</h1>
      </div>
    </div>
  </div>
</div>

<?php
// Kode otomatis untuk NIS (format S-001 dst)
$carikode = mysqli_query($koneksi,"SELECT MAX(Nis) FROM tabel_siswa") or die (mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if($datakode[0] != null) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "S-".str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "S-001";
}
$_SESSION["KODE_SISWA"] = $hasilkode;

if(isset($_POST['tambah'])){
    $nis = trim($_POST['nis']);
    $nm_siswa = trim($_POST['nm_siswa']);
    $jenkel = trim($_POST['jenkel']);
    $hp = trim($_POST['hp']);
    $id_kelas = trim($_POST['id_kelas']);
    $pass = md5(trim($_POST['password'])); // Enkripsi sandi

    // Sesuaikan urutan kolom dengan tabelmu: Nis, Nm_siswa, Jenkel, Hp, Id_kelas, Password
    $insert = mysqli_query($koneksi,"INSERT INTO tabel_siswa 
    (Nis, Nm_siswa, Jenkel, Hp, Id_kelas, Password)
    VALUES ('$nis','$nm_siswa','$jenkel','$hp','$id_kelas','$pass')");

    if ($insert) {
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
        <h5><i class="icon fas fa-check"></i> Berhasil </h5>
        <h4>Data Siswa Berhasil Disimpan!</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';
    }else{
        echo '<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> Gagal </h5>
        <h4>Gagal Disimpan: '.mysqli_error($koneksi).'</h4></div>';
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
            <input type="text" name="nis" value="<?= $hasilkode; ?>" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label for="nm_siswa">Nama Siswa</label>
            <input type="text" name="nm_siswa" id="nm_siswa" placeholder="Nama Lengkap Siswa" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="jenkel">Jenis Kelamin</label>
            <select name="jenkel" class="form-control" required>
              <option value="">-- Pilih --</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="form-group">
            <label for="hp">No HP</label>
            <input type="text" name="hp" id="hp" placeholder="08xxxxxxxxx" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="id_kelas">Kelas</label>
            <input type="text" name="id_kelas" id="id_kelas" placeholder="Contoh: 1, 2" class="form-control" required>
          </div>
          <!-- BARIS BARU: Kolom Kata Sandi -->
          <div class="form-group">
            <label for="password">Kata Sandi Awal</label>
            <input type="password" name="password" id="password" placeholder="Buat sandi untuk login" class="form-control" required>
          </div>
          <div class="card-footer">
            <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
            <a href="index.php?page=siswa" class="btn btn-secondary ml-2">Kembali</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>