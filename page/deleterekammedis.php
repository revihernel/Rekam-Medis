<?php
ob_start();
include "../koneksi.php";
include "item/menu.php";

// Ambil no_transaksi dari URL
if (isset($_GET['x'])) {
    $no_transaksi = $_GET['x'];

    // Cek apakah data rekam medis ada
    $sql_check = "SELECT * FROM trekammedis WHERE no_transaksi = '$no_transaksi'";
    $result_check = $koneksi->query($sql_check);

    if ($result_check->num_rows > 0) {
        // Jika data ada, hapus data rekam medis
        $sql_delete = "DELETE FROM trekammedis WHERE no_transaksi = '$no_transaksi'";

        if ($koneksi->query($sql_delete) === TRUE) {
            // Redirect ke halaman data_rekammedis.php setelah berhasil dihapus
            header("Location: data_rekammedis.php");
            exit;
        } else {
            echo "<div class='alert alert-danger'>Error: " . $koneksi->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Data tidak ditemukan!</div>";
    }

    $koneksi->close();
} else {
    echo "<div class='alert alert-danger'>No Transaksi tidak ditemukan!</div>";
}
?>
