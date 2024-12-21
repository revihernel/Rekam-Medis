<?php
ob_start();
include "item/menu.php";
include "../koneksi.php";

// Ambil data peserta dan bidan
$sql1 = "SELECT * FROM tpeserta";
$result1 = $koneksi->query($sql1);

$sql2 = "SELECT * FROM tbidan";
$result2 = $koneksi->query($sql2);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_transaksi = $_POST['no_transaksi'];
    $kode_peserta = $_POST['nama_peserta'];
    $tgl_berobat = $_POST['thn'] . '-' . str_pad($_POST['bln'], 2, '0', STR_PAD_LEFT) . '-' . str_pad($_POST['tgl_berobat'], 2, '0', STR_PAD_LEFT); // Format tanggal
    $kode_bidan = $_POST['nama_bidan'];
    $keluhan = $_POST['keluhan'];
    $biaya_admin = $_POST['biaya_admin'];

    $sql = "INSERT INTO trekammedis (no_transaksi, kode_peserta, tgl_berobat, kode_bidan, keluhan, biaya_admin)
            VALUES ('$no_transaksi', '$kode_peserta', '$tgl_berobat', '$kode_bidan', '$keluhan', '$biaya_admin')";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: data_rekammedis.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $koneksi->error . "</div>";
    }

    $koneksi->close();
}
?>

<div class="container mt-5 mb-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="text-start">Tambah Data Rekam Medis</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <!-- Input Nomor Transaksi -->
                <div class="mb-3">
                    <label for="no_transaksi" class="form-label">Nomor Transaksi</label>
                    <input type="text" class="form-control" id="no_transaksi" name="no_transaksi" required>
                </div>

                <!-- Dropdown Nama Peserta -->
                <div class="mb-3">
                    <label for="nama_peserta" class="form-label">Nama Peserta</label>
                    <select name="nama_peserta" class="form-select" required>
                        <option value="" disabled selected>Pilih Peserta</option>
                        <?php while ($row1 = $result1->fetch_assoc()) { ?>
                            <option value="<?= $row1["kode_peserta"]; ?>"><?= $row1["nama_peserta"]; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Input Tanggal Berobat -->
                <div class="mb-3">
                    <label for="tgl_berobat" class="form-label">Tanggal Berobat</label>
                    <div class="d-flex">
                        <input type="number" name="tgl_berobat" class="form-control w-25" min="1" max="31" placeholder="Tanggal" required>
                        <select name="bln" class="form-select w-50 ms-2" required>
                            <option value="" disabled selected>Pilih Bulan</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <input type="number" name="thn" class="form-control w-25 ms-2" min="2000" max="2099" placeholder="Tahun" required>
                    </div>
                </div>

                <!-- Dropdown Nama Bidan -->
                <div class="mb-3">
                    <label for="nama_bidan" class="form-label">Nama Bidan</label>
                    <select name="nama_bidan" class="form-select" required>
                        <option value="" disabled selected>Pilih Bidan</option>
                        <?php while ($row2 = $result2->fetch_assoc()) { ?>
                            <option value="<?= $row2["kode_bidan"]; ?>"><?= $row2["nama_bidan"]; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Input Keluhan -->
                <div class="mb-3">
                    <label for="keluhan" class="form-label">Keluhan</label>
                    <input type="text" name="keluhan" id="keluhan" class="form-control" required>
                </div>

                <!-- Input Biaya Administrasi -->
                <div class="mb-3">
                    <label for="biaya_admin" class="form-label">Biaya Administrasi</label>
                    <input type="number" name="biaya_admin" id="biaya_admin" class="form-control" required>
                </div>

                <!-- Tombol Simpan dan Clear -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="reset" class="btn btn-danger">Clear</button>
                </div>
            </form>
        </div>
    </div>
</div>
