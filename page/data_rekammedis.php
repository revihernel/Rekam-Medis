<?php
ob_start();
include "../koneksi.php";
include "item/menu.php";
$sql = "SELECT trekammedis.*, tpeserta.nama_peserta, tpeserta.jenis_kelamin, tbidan.nama_bidan, tpoli.nama_poli
        FROM trekammedis
        JOIN tbidan ON tbidan.kode_bidan = trekammedis.kode_bidan
        JOIN tpeserta ON tpeserta.kode_peserta = trekammedis.kode_peserta
        JOIN tpoli ON tbidan.kode_poli = tpoli.kode_poli"; 
$result = $koneksi->query($sql);

if (!$result) {
    echo "<div class='alert alert-danger'>Error: " . $koneksi->error . "</div>";
}
?>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Data Rekam Medis</h2>
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary me-2" onclick="location.href='addrekammedis.php'">Add New</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No Transaksi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama Peserta</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Keluhan</th>
                        <th scope="col">Nama Poli</th>
                        <th scope="col">Bidan</th>
                        <th scope="col">Biaya Administrasi</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= htmlspecialchars($row["no_transaksi"]); ?></td>
                                <td><?= htmlspecialchars($row["tgl_berobat"]); ?></td>
                                <td><?= htmlspecialchars($row["nama_peserta"]); ?></td>
                                <td><?= htmlspecialchars($row["jenis_kelamin"]); ?></td>
                                <td><?= htmlspecialchars($row["keluhan"]); ?></td>
                                <td><?= htmlspecialchars($row["nama_poli"]); ?></td>
                                <td><?= htmlspecialchars($row["nama_bidan"]); ?></td>
                                <td>Rp <?= number_format($row["biaya_admin"], 0, ',', '.'); ?></td>
                                <td>
                                    <a href="editrekammedis.php?notrans=<?= $row["no_transaksi"] ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="deleterekammedis.php?x=<?= $row["no_transaksi"] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Data Anda akan dihapus, klik OK untuk melanjutkan')">Delete</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='9'>No records found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
