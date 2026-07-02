<?php
require_once "config/koneksi.php";
// session_start(); 👉 HAPUS BARIS INI!
$user = $_SESSION['username'];
$role = $_SESSION['role'];

if(isset($_POST['simpan'])){
    $lama = md5(trim($_POST['lama']));
    $baru = md5(trim($_POST['baru']));
    $konfirm = md5(trim($_POST['konfirmasi']));

    // Cek sandi baru sama dengan konfirmasi
    if($baru != $konfirm){
        echo '<script>alert("Sandi baru dan konfirmasi tidak cocok!");</script>';
    }else{
        // Cek sandi lama sesuai di database
        $sesuai = false;
        if($role == 'admin'){
            $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE Username='$user' AND Password='$lama'");
            $sesuai = mysqli_num_rows($cek) > 0;
            $tabel = 'users'; $kolom = 'Username';
        }elseif($role == 'guru'){
            $cek = mysqli_query($koneksi, "SELECT * FROM tabel_guru WHERE Kd_guru='$user' AND Password='$lama'");
            $sesuai = mysqli_num_rows($cek) > 0;
            $tabel = 'tabel_guru'; $kolom = 'Kd_guru';
        }else{
            $cek = mysqli_query($koneksi, "SELECT * FROM tabel_siswa WHERE Nis='$user' AND Password='$lama'");
            $sesuai = mysqli_num_rows($cek) > 0;
            $tabel = 'tabel_siswa'; $kolom = 'Nis';
        }

        if(!$sesuai){
            echo '<script>alert("Kata sandi lama salah!");</script>';
        }else{
            // Update sandi baru
            $update = mysqli_query($koneksi, "UPDATE $tabel SET Password='$baru' WHERE $kolom='$user'");
            if($update){
                echo '<script>alert("Kata sandi berhasil diubah! Silakan login kembali."); window.location="logout.php";</script>';
            }else{
                echo '<script>alert("Gagal mengubah sandi!");</script>';
            }
        }
    }
}
?>

<div class="content-header">
  <div class="container-fluid">
    <h1>Ubah Kata Sandi</h1>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <form method="POST">
            <div class="form-group">
              <label>Kata Sandi Lama</label>
              <input type="password" name="lama" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Kata Sandi Baru</label>
              <input type="password" name="baru" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Konfirmasi Kata Sandi Baru</label>
              <input type="password" name="konfirmasi" class="form-control" required>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>