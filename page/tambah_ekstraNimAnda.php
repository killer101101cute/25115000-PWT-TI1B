<?php
session_start();
require_once "config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Data Ekstrakurikuler Nim Anda</h1>
      </div>
    </div>
  </div>
</div>

<?php
// Kode Otomatis
$carikode = mysqli_query($koneksi, "SELECT MAX(id_ekstra033) FROM ekstra_nimanda") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);

if($datakode[0] != null) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode = "M-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $hasilkode = "M-001";
}

$_SESSION["KODE"] = $hasilkode;

// Proses Simpan Data
if(isset($_POST['tambah'])){
    $id_ekstra033   = $_POST['id_ekstra033'];
    $nama_ekstra033 = $_POST['nama_ekstra033'];
    $ket033         = $_POST['ket033'];
    $semester033    = $_POST['semester033'];
    $thn_ajaran033  = $_POST['thn_ajaran033'];

    $insert = mysqli_query($koneksi, "INSERT INTO ekstra_nimanda 
                (id_ekstra033, nama_ekstra033, ket033, semester033, thn_ajaran033) 
                VALUES 
                ('$id_ekstra033', '$nama_ekstra033', '$ket033', '$semester033', '$thn_ajaran033')");

    if ($insert) {
        echo '<div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra_nimanda">';
    }else{
        echo '<div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info</h5>
        <h4>Gagal Disimpan : '.mysqli_error($koneksi).'</h4></div>';
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
              <label for="id_ekstra033">Kode Ekstra</label>
              <input type="text" name="id_ekstra033" value="<?= $hasilkode; ?>" placeholder="Id Ekstra" class="form-control" readonly>
            </div>
             <div class="form-group">
              <label for="nama_ekstra033">Nama Ekstrakurikuler</label>
              <input type="text" name="nama_ekstra033" id="nama_ekstra033" placeholder="Contoh: Pramuka / Paskibra" class="form-control" required>
            </div>
             <div class="form-group">
              <label for="ket033">Keterangan</label>
              <input type="text" name="ket033" id="ket033" placeholder="Keterangan Tambahan" class="form-control">
            </div>
            <div class="form-group">
              <label for="semester033">Semester</label>
              <input type="text" name="semester033" id="semester033" placeholder="Contoh: Ganjil / Genap" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="thn_ajaran033">Tahun Ajaran</label>
              <input type="text" name="thn_ajaran033" id="thn_ajaran033" placeholder="Contoh: 2025/2026" class="form-control" required>
            </div>
            <div class="card-footer">
              <input type="submit" class="btn btn-primary" name="tambah" value="Simpan Data">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>