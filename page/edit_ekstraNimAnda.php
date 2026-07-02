<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <!-- ✅ Judul diubah -->
        <h1 class="m-0 text-dark">Edit Data Ekstrakurikuler</h1>
      </div>
    </div>
  </div>
</div>

<?php
// ✅ Ambil kode dari URL (sesuai kolom utama)
$kd = $_GET['kd'];
// ✅ Ubah nama tabel & kolom sesuai database kamu: ekstra_nimanda & id_ekstra033
$edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM ekstra_nimanda WHERE id_ekstra033='$kd' "));

if(isset($_POST['ubah'])){ // ✅ Nama tombol diubah jadi 'ubah' biar jelas
  // ✅ Ambil semua data sesuai kolom yang ada
  $id_ekstra033   = $_POST['id_ekstra033'];
  $nama_ekstra033 = $_POST['nama_ekstra033'];
  $ket033         = $_POST['ket033'];
  $semester033    = $_POST['semester033'];
  $thn_ajaran033  = $_POST['thn_ajaran033'];

  // ✅ Query UPDATE diubah sesuai nama tabel & kolom lengkap
  $update = mysqli_query($koneksi,"UPDATE ekstra_nimanda SET 
            nama_ekstra033  = '$nama_ekstra033',
            ket033          = '$ket033',
            semester033     = '$semester033',
            thn_ajaran033   = '$thn_ajaran033'
            WHERE id_ekstra033 = '$id_ekstra033' ");

  if ($update) {
    echo '<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-check"></i> Berhasil </h5>
      Data Berhasil Diubah
    </div>';
    // ✅ Redirect ke halaman daftar ekstra
    echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra_nimanda">';
  }else{
    echo '<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-times"></i> Gagal </h5>
      Data Gagal Diubah : '.mysqli_error($koneksi).'
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

            <!-- ✅ Semua kolom disesuaikan dengan database -->
            <div class="form-group">
              <label for="id_ekstra033">Kode Ekstra</label>
              <input type="text" name="id_ekstra033" value="<?=$edit['id_ekstra033']; ?>" class="form-control" readonly>
            </div>

            <div class="form-group">
              <label for="nama_ekstra033">Nama Ekstrakurikuler</label>
              <input type="text" name="nama_ekstra033" value="<?=$edit['nama_ekstra033']; ?>" id="nama_ekstra033" placeholder="Contoh: Pramuka / Paskibra" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="ket033">Keterangan</label>
              <input type="text" name="ket033" value="<?=$edit['ket033']; ?>" id="ket033" placeholder="Keterangan Tambahan" class="form-control">
            </div>

            <div class="form-group">
              <label for="semester033">Semester</label>
              <input type="text" name="semester033" value="<?=$edit['semester033']; ?>" id="semester033" placeholder="Contoh: Ganjil / Genap" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="thn_ajaran033">Tahun Ajaran</label>
              <input type="text" name="thn_ajaran033" value="<?=$edit['thn_ajaran033']; ?>" id="thn_ajaran033" placeholder="Contoh: 2025/2026" class="form-control" required>
            </div>

            <div class="card-footer">
              <!-- ✅ Nama tombol diubah & tambah ikon -->
              <input type="submit" class="btn btn-primary" name="ubah" value="Simpan Perubahan">
              <a href="index.php?page=ekstra_nimanda" class="btn btn-secondary">Kembali</a>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>