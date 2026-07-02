<?php
require_once "config/koneksi.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <!-- ✅ Judul disesuaikan -->
        <h1 class="m-0 text-dark">Data Ekstrakurikuler Nim Anda</h1>
      </div>
    </div>
  </div>
</div>

<?php
// ✅ PROSES HAPUS DATA (DIPERBAIKI)
if(isset($_GET['action'])) {
  if($_GET['action'] == "hapus") {
    $kd = $_GET['kd'];
    // ✅ Nama tabel & kolom DISAMAKAN DENGAN DATABASE
    $query = mysqli_query($koneksi, "DELETE FROM ekstra_nimanda WHERE id_ekstra033 = '$kd' ");
    if($query){
      echo '
      <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Berhasil</h5>
        Data Berhasil Dihapus!
      </div>';
      echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra_nimanda">'; // ✅ Link redirect disesuaikan
    } else {
      echo '
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-times"></i> Gagal</h5>
        Data Gagal Dihapus: '.mysqli_error($koneksi).'
      </div>';
    }
  }
}
?>

<div class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <!-- ✅ Tombol Tambah (Link disesuaikan) -->
        <a href="index.php?page=tambah_ekstraNimAnda" class="btn btn-primary btn-sm mb-2">
          <i class="fa fa-plus"></i> Tambah Data Ekstra
        </a>

        <table class="table table-bordered table-striped">
          <thead> <!-- ✅ Salah tulis <tread> jadi <thead> -->
            <tr>
              <th>No</th>
              <th>Kode Ekstra</th>
              <th>Nama Ekstra</th>
              <th>Keterangan</th>
              <th>Semester</th>
              <th>Tahun Ajaran</th>
              <th width="15%">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 0;
            // ✅ PERBAIKAN UTAMA: Nama tabel BENAR = ekstra_nimanda (bukan extra_nimanda)
            $query = mysqli_query($koneksi, "SELECT * FROM ekstra_nimanda ORDER BY id_ekstra033 ASC");
            while ($result = mysqli_fetch_array($query) ) {
              $no++;
            ?>
            <tr>
              <td><?= $no; ?></td>
              <td><?= $result['id_ekstra033']; ?></td>
              <td><?= $result['nama_ekstra033']; ?></td>
              <td><?= $result['ket033']; ?></td>
              <td><?= $result['semester033']; ?></td>
              <td><?= $result['thn_ajaran033']; ?></td>
              <td>
                <!-- ✅ Tombol Hapus & Edit diperbaiki -->
                <a href="index.php?page=ekstra_nimanda&action=hapus&kd=<?= $result['id_ekstra033'] ?>" 
                   class="badge badge-danger" 
                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                  <i class="fa fa-trash"></i> Hapus
                </a>
                
                <a href="index.php?page=edit_ekstraNimAnda&kd=<?= $result['id_ekstra033'] ?>" 
                   class="badge badge-warning ml-1">
                  <i class="fa fa-edit"></i> Edit
                </a>
              </td>
            </tr>
            <?php } ?>

            <?php 
            // ✅ Kalau data kosong, tampilkan pesan
            if($no == 0){
              echo "<tr><td colspan='7' class='text-center'>Belum ada data tersimpan</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>