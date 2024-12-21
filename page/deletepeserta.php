<?php
ob_start();
include "item/menu.php";
include "../koneksi.php";

if (isset($_GET['kode_peserta'])) {
    $kode_peserta = $_GET['kode_peserta'];
    $sql = "DELETE FROM tpeserta WHERE kode_peserta = '$kode_peserta'";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: data_peserta.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $koneksi->error . "</div>";
    }
} else {
    // Jika tidak ada kode_peserta di URL
    echo "<div class='alert alert-danger'>Kode peserta tidak ditemukan!</div>";
}

$koneksi->close();
