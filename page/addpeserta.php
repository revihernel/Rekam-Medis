<?php
ob_start();
include "item/menu.php";
include "../koneksi.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_peserta = $_POST['kode_peserta'];
    $nama_peserta = $_POST['nama_peserta'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    $sql = "INSERT INTO tpeserta (kode_peserta, nama_peserta, tanggal_lahir, jenis_kelamin, alamat, telepon, email)
            VALUES ('$kode_peserta', '$nama_peserta', '$tanggal_lahir', '$jenis_kelamin', '$alamat', '$telepon', '$email')";
    if ($koneksi->query($sql) === TRUE) {
        header("Location: data_peserta.php");
    
    } else {
        echo "<div class='alert alert-danger'>Error: " . $koneksi->error . "</div>";
    }
    $koneksi->close();
}
?>
<div class="container mt-2 mb-4">

    <div class="card-header text-black-bold mb-5">
        <h4 class="text-start ">Tambah Peserta</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="kode_peserta" class="form-label">Kode Peserta</label>
                <input type="text" class="form-control" id="kode_peserta" name="kode_peserta" required>
            </div>
            <div class="mb-3">
                <label for="nama_peserta" class="form-label">Nama Peserta</label>
                <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Simpan</button>
        </form>
    </div>

</div>