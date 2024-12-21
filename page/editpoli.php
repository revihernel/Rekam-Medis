<?php
ob_start();
include "item/menu.php";
include "../koneksi.php";

// Menangkap kode_poli dari URL
if (isset($_GET['kode_poli'])) {
    $kode_poli = $_GET['kode_poli'];

    // Mengambil data dari database berdasarkan kode_poli
    $sql = "SELECT * FROM tpoli WHERE kode_poli = '$kode_poli'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $kode_poli = $row['kode_poli'];
        $nama_poli = $row['nama_poli'];
    } else {
        echo "<div class='alert alert-warning'>Poli tidak ditemukan.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>Kode Poli tidak ditemukan.</div>";
    exit;
}

// Mengecek jika form disubmit dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menangkap data yang dikirimkan dari form
    $kode_poli = $_POST['kode_poli'];
    $nama_poli = $_POST['nama_poli'];

    // Query untuk update data di tabel poli
    $sql = "UPDATE tpoli SET nama_poli = '$nama_poli' WHERE kode_poli = '$kode_poli'";

    // Mengeksekusi query
    if ($koneksi->query($sql) === TRUE) {
        // Jika berhasil, arahkan ke halaman data_poli.php
        header("Location: data_poli.php");
        exit;
    } else {
        // Jika gagal, tampilkan pesan error
        echo "<div class='alert alert-danger'>Error: " . $koneksi->error . "</div>";
    }

    // Menutup koneksi
    $koneksi->close();
}
?>

<div class="container mt-2 mb-4">
    <div class="card-header text-black-bold mb-5">
        <h4 class="text-start ">Edit Poli</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="kode_poli" class="form-label">Kode Poli</label>
                <input type="text" class="form-control" id="kode_poli" name="kode_poli" value="<?= $kode_poli; ?>" readonly required>
            </div>
            <div class="mb-3">
                <label for="nama_poli" class="form-label">Nama Poli</label>
                <input type="text" class="form-control" id="nama_poli" name="nama_poli" value="<?= $nama_poli; ?>" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Update</button>
        </form>
    </div>
</div>