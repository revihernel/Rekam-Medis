<?php
ob_start();
include "item/menu.php";
include "../koneksi.php";

// Mengecek apakah kode_poli ada di URL
if (isset($_GET['kode_poli'])) {
    $kode_poli = $_GET['kode_poli'];

    // Query untuk menghapus data berdasarkan kode_poli
    $sql = "DELETE FROM tpoli WHERE kode_poli = '$kode_poli'";

    // Mengeksekusi query
    if ($koneksi->query($sql) === TRUE) {
        // Jika berhasil, arahkan ke halaman data_poli.php
        header("Location: data_poli.php");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<div class='alert alert-danger'>Error: " . $koneksi->error . "</div>";
    }
} else {
    // Jika tidak ada kode_poli, arahkan kembali ke halaman data_poli.php
    echo "<div class='alert alert-danger'>Kode Poli tidak ditemukan.</div>";
    exit;
}

// Menutup koneksi
$koneksi->close();
