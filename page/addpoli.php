<?php
ob_start();
include "item/menu.php";
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_poli = $_POST['kode_poli'];
    $nama_poli = $_POST['nama_poli'];

    $sql = "INSERT INTO tpoli (kode_poli, nama_poli)
            VALUES ('$kode_poli', '$nama_poli')";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: data_poli.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $koneksi->error . "</div>";
    }
    $koneksi->close();
}
?>

<div class="container mt-2 mb-4">
    <div class="card-header text-black-bold mb-5">
        <h4 class="text-start ">Tambah Poli</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="kode_poli" class="form-label">Kode Poli</label>
                <input type="text" class="form-control" id="kode_poli" name="kode_poli" required>
            </div>
            <div class="mb-3">
                <label for="nama_poli" class="form-label">Nama Poli</label>
                <input type="text" class="form-control" id="nama_poli" name="nama_poli" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Simpan</button>
        </form>
    </div>
</div>
