<?php
ob_start();
include "../koneksi.php";
include "item/menu.php";

// Ambil no_transaksi dari URL
if (isset($_GET['notrans'])) {
    $no_transaksi = $_GET['notrans'];

    // Ambil data rekam medis berdasarkan no_transaksi
    $sql = "SELECT trekammedis.*, tpeserta.nama_peserta, tpeserta.jenis_kelamin, tbidan.nama_bidan, tpoli.nama_poli
            FROM trekammedis
            JOIN tbidan ON tbidan.kode_bidan = trekammedis.kode_bidan
            JOIN tpeserta ON tpeserta.kode_peserta = trekammedis.kode_peserta
            JOIN tpoli ON tbidan.kode_poli = tpoli.kode_poli
            WHERE trekammedis.no_transaksi = '$no_transaksi'";

    $result = $koneksi->query($sql);

    // Jika data ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Data tidak ditemukan!</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>No Transaksi tidak ditemukan!</div>";
    exit;
}

// Ambil data peserta dan bidan untuk dropdown
$sql1 = "SELECT * FROM tpeserta";
$result1 = $koneksi->query($sql1);

$sql2 = "SELECT * FROM tbidan";
$result2 = $koneksi->query($sql2);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $no_transaksi = $_POST['no_transaksi'];
    $kode_peserta = $_POST['nama_peserta'];
    $tgl_berobat = $_POST['tgl_berobat'] . '-' . $_POST['bln'] . '-' . $_POST['thn']; // Format tanggal
    $kode_bidan = $_POST['nama_bidan'];
    $keluhan = $_POST['keluhan'];
    $biaya_admin = $_POST['biaya_admin'];

    // Update data rekam medis
    $sql_update = "UPDATE trekammedis
                   SET kode_peserta = '$kode_peserta',
                       tgl_berobat = '$tgl_berobat',
                       kode_bidan = '$kode_bidan',
                       keluhan = '$keluhan',
                       biaya_admin = '$biaya_admin'
                   WHERE no_transaksi = '$no_transaksi'";

    if ($koneksi->query($sql_update) === TRUE) {
        header("Location: data_rekammedis.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $koneksi->error . "</div>";
    }

    $koneksi->close();
}
?>

<body>
    <div class="container mt-5 mb-4">
        <h2 class="text-center mb-4">Edit Data Rekam Medis</h2>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="text-start">Form Edit Rekam Medis</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="no_transaksi" class="form-label">Nomor Transaksi</label>
                        <input type="text" class="form-control" id="no_transaksi" name="no_transaksi" value="<?= htmlspecialchars($row['no_transaksi']); ?>" readonly required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_peserta" class="form-label">Nama Peserta</label>
                        <select name="nama_peserta" class="form-select" required>
                            <option value="<?= $row['kode_peserta']; ?>" selected><?= $row['nama_peserta']; ?></option>
                            <?php while ($row1 = $result1->fetch_assoc()) { ?>
                                <option value="<?= $row1['kode_peserta']; ?>"><?= $row1['nama_peserta']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tgl_berobat" class="form-label">Tanggal Berobat</label>
                        <div class="d-flex">
                            <input type="number" name="tgl_berobat" class="form-control w-25" min="1" max="31" value="<?= date('d', strtotime($row['tgl_berobat'])); ?>" required>
                            <select name="bln" class="form-select w-50 ms-2" required>
                                <option value="<?= date('m', strtotime($row['tgl_berobat'])); ?>" selected><?= date('F', strtotime($row['tgl_berobat'])); ?></option>
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
                            <input type="number" name="thn" class="form-control w-25 ms-2" min="2000" max="2099" value="<?= date('Y', strtotime($row['tgl_berobat'])); ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_bidan" class="form-label">Nama Bidan</label>
                        <select name="nama_bidan" class="form-select" required>
                            <option value="<?= $row['kode_bidan']; ?>" selected><?= $row['nama_bidan']; ?></option>
                            <?php while ($row2 = $result2->fetch_assoc()) { ?>
                                <option value="<?= $row2['kode_bidan']; ?>"><?= $row2['nama_bidan']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <input type="text" name="keluhan" id="keluhan" class="form-control" value="<?= htmlspecialchars($row['keluhan']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="biaya_admin" class="form-label">Biaya Administrasi</label>
                        <input type="number" name="biaya_admin" id="biaya_admin" class="form-control" value="<?= htmlspecialchars($row['biaya_admin']); ?>" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="data_rekammedis.php" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>