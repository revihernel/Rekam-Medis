<?php
include "../koneksi.php";
include "item/menu.php";
$no = 1;
$sql = "SELECT * FROM tpeserta ";
$result = $koneksi->query($sql);
?>


    <div class="container mt-5">
        <h2 class="text-center mb-4">Data Peserta</h2>
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary me-2" onclick="location.href='addpeserta.php'">Tambah Peserta</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Peserta</th>
                        <th scope="col">Nama Peserta</th>
                        <th scope="col">Tanggal Lahir</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_array()) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row["kode_peserta"]; ?></td>
                            <td><?= $row["nama_peserta"]; ?></td>
                            <td><?= $row["tanggal_lahir"]; ?></td>
                            <td><?= $row["jenis_kelamin"]; ?></td>
                            <td><?= $row["alamat"]; ?></td>
                            <td><?= $row["telepon"]; ?></td>
                            <td><?= $row["email"]; ?></td>
                            <td>
                                <a href="editpeserta.php?kode_peserta=<?= $row["kode_peserta"] ?>"
                                    class="text-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="deletepeserta.php?kode_peserta=<?= $row["kode_peserta"] ?>"
                                    class="text-danger"
                                    onclick="return confirm('Data Anda akan dihapus, klik OK untuk melanjutkan')">
                                    <i class="fas fa-trash"></i>
                                </a>

                            </td>
                        </tr>
                    <?php
                    };
                    ?>
                </tbody>
            </table>
        </div>
    </div>