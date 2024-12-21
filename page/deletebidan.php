<?php
ob_start();
include "item/menu.php";
include "../koneksi.php";

if (isset($_GET['kode_bidan'])) {
    $kode_bidan = $_GET['kode_bidan'];
    $sql = "DELETE FROM tbidan WHERE kode_bidan = '$kode_bidan'";
    if ($koneksi->query($sql) === TRUE) {
        header("Location: data_bidan.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $koneksi->error . "</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Kode bidan tidak ditemukan!</div>";
}
$koneksi->close();
?>
