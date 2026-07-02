<?php
require_once "config/koneksi.php";

if(isset($_POST['simpan'])){
    // Ambil data utama
    $id_kelas    = trim($_POST['id_kelas']);
    $thn_ajaran  = trim($_POST['thn_ajaran']);
    $semester    = trim($_POST['semester']);

    // Validasi data utama tidak kosong
    if(empty($id_kelas) || empty($thn_ajaran) || empty($semester)){
        $pesan = "Data utama tidak boleh kosong!";
    }else{
        // 1. Simpan ke tabel jadwal_kelas
        $sql1 = "INSERT INTO tabel_jadwal_kelas (Id_kelas, Thn_ajaran, Semester) 
                 VALUES ('$id_kelas', '$thn_ajaran', '$semester')";
        $query1 = mysqli_query($koneksi, $sql1);

        if(!$query1){
            $pesan = "Gagal simpan jadwal utama: " . mysqli_error($koneksi);
        }else{
            $id_jadwal_baru = mysqli_insert_id($koneksi);

            // Ambil data array
            $kd_mapel_arr   = $_POST['kd_mapel'];
            $kd_guru_arr    = $_POST['kd_guru'];
            $hari_arr       = $_POST['hari'];
            $mulai_arr      = $_POST['jam_mulai'];
            $selesai_arr    = $_POST['jam_selesai'];

            $jumlah_berhasil = 0;
            $pesan_error = "";

            // 2. Simpan ke detail jadwal
            foreach ($kd_mapel_arr as $i => $kd_mapel) {
                $kd_guru    = trim($kd_guru_arr[$i]);
                $hari       = trim($hari_arr[$i]);
                $jam_mulai  = trim($mulai_arr[$i]);
                $jam_selesai= trim($selesai_arr[$i]);
                $kd_mapel   = trim($kd_mapel);

                // Lewati jika ada data baris kosong
                if(empty($kd_mapel) || empty($kd_guru) || empty($hari) || empty($jam_mulai) || empty($jam_selesai)){
                    continue;
                }

                $sql2 = "INSERT INTO tabel_detail_jadwal 
                        (Id_jadwal, Kd_mapel, Kd_guru, Hari, Jam_mulai, Jam_selesai) 
                        VALUES ('$id_jadwal_baru', '$kd_mapel', '$kd_guru', '$hari', '$jam_mulai', '$jam_selesai')";
                
                $query2 = mysqli_query($koneksi, $sql2);
                
                if($query2){
                    $jumlah_berhasil++;
                }else{
                    $pesan_error = mysqli_error($koneksi);
                }
            }

            // Tampilkan hasil
            if($jumlah_berhasil > 0){
                $pesan = "✅ Berhasil! Tersimpan $jumlah_berhasil jadwal pelajaran.";
                $redirect = true;
            }else{
                $pesan = "❌ Gagal simpan detail: " . $pesan_error;
                // Hapus jadwal utama jika tidak ada detail yang tersimpan
                mysqli_query($koneksi, "DELETE FROM tabel_jadwal_kelas WHERE Id_jadwal = '$id_jadwal_baru'");
            }
        }
    }
}
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah Jadwal Kelas</h1>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body p-3">
        <?php if(isset($pesan)): ?>
        <div class="alert <?= strpos($pesan, '✅') !== false ? 'alert-success' : 'alert-danger' ?> alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?= $pesan ?>
        </div>
        <?php if(isset($redirect)) echo '<meta http-equiv="refresh" content="2;url=index.php?page=jadwal">'; ?>
        <?php endif; ?>

        <form method="POST" action="">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Pilih Kelas</label>
                <select name="id_kelas" class="form-control" required>
                  <option value="">-- Pilih Kelas --</option>
                  <?php
                  $dt_kelas = mysqli_query($koneksi, "SELECT * FROM tabel_kelas ORDER BY Nm_kelas");
                  while($k = mysqli_fetch_array($dt_kelas)){
                      echo "<option value='$k[Id_kelas]'>$k[Nm_kelas]</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Tahun Ajaran</label>
                <input type="text" name="thn_ajaran" class="form-control" placeholder="Contoh: 2025/2026" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Semester</label>
                <select name="semester" class="form-control" required>
                  <option value="">-- Pilih --</option>
                  <option value="ganjil">Ganjil</option>
                  <option value="genap">Genap</option>
                </select>
              </div>
            </div>
          </div>

          <hr>
          <h5>Isi Jadwal Pelajaran</h5>
          <div id="wadah_baris">
            <div class="row mb-2">
              <div class="col-md-2">
                <select name="kd_mapel[]" class="form-control" required>
                  <option value="">Mapel</option>
                  <?php
                  $dt_mapel = mysqli_query($koneksi, "SELECT * FROM tabel_mapel ORDER BY Nm_mapel");
                  while($m = mysqli_fetch_array($dt_mapel)){
                      echo "<option value='$m[Kd_mapel]'>$m[Nm_mapel]</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-2">
                <select name="kd_guru[]" class="form-control" required>
                  <option value="">Guru</option>
                  <?php
                  $dt_guru = mysqli_query($koneksi, "SELECT * FROM tabel_guru ORDER BY Nm_guru");
                  while($g = mysqli_fetch_array($dt_guru)){
                      echo "<option value='$g[Kd_guru]'>$g[Nm_guru]</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-2">
                <select name="hari[]" class="form-control" required>
                  <option value="">Hari</option>
                  <option value="Senin">Senin</option>
                  <option value="Selasa">Selasa</option>
                  <option value="Rabu">Rabu</option>
                  <option value="Kamis">Kamis</option>
                  <option value="Jumat">Jumat</option>
                </select>
              </div>
              <div class="col-md-3">
                <div class="input-group">
                  <input type="time" name="jam_mulai[]" class="form-control" required>
                  <span class="input-group-text">s/d</span>
                  <input type="time" name="jam_selesai[]" class="form-control" required>
                </div>
              </div>
            </div>
          </div>

          <button type="button" class="btn btn-success btn-sm mb-3" onclick="tambahBaris()">➕ Tambah Baris Jadwal</button>

          <div class="card-footer text-center">
            <button type="submit" name="simpan" class="btn btn-primary">Simpan Semua Jadwal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
function tambahBaris(){
    let barisBaru = `
    <div class="row mb-2">
      <div class="col-md-2">
        <select name="kd_mapel[]" class="form-control" required>
          <option value="">Mapel</option>
          <?php $dt_mapel = mysqli_query($koneksi,"SELECT * FROM tabel_mapel"); while($m=mysqli_fetch_array($dt_mapel)){echo "<option value='$m[Kd_mapel]'>$m[Nm_mapel]</option>";} ?>
        </select>
      </div>
      <div class="col-md-2">
        <select name="kd_guru[]" class="form-control" required>
          <option value="">Guru</option>
          <?php $dt_guru = mysqli_query($koneksi,"SELECT * FROM tabel_guru"); while($g=mysqli_fetch_array($dt_guru)){echo "<option value='$g[Kd_guru]'>$g[Nm_guru]</option>";} ?>
        </select>
      </div>
      <div class="col-md-2">
        <select name="hari[]" class="form-control" required>
          <option value="">Hari</option>
          <option value="Senin">Senin</option>
          <option value="Selasa">Selasa</option>
          <option value="Rabu">Rabu</option>
          <option value="Kamis">Kamis</option>
          <option value="Jumat">Jumat</option>
        </select>
      </div>
      <div class="col-md-3">
        <div class="input-group">
          <input type="time" name="jam_mulai[]" class="form-control" required>
          <span class="input-group-text">s/d</span>
          <input type="time" name="jam_selesai[]" class="form-control" required>
        </div>
      </div>
    </div>`;
    document.getElementById("wadah_baris").insertAdjacentHTML('beforeend', barisBaru);
}
</script>