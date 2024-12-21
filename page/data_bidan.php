<?php
include "../koneksi.php";
include "item/menu.php";
$no = 1;
$sql = "SELECT * FROM tbidan JOIN tpoli ON tpoli.kode_poli=tbidan.kode_poli";
$result = $koneksi->query($sql);
?>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Data Bidan</h2>
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary me-2" onclick="location.href='addbidan.php'">Tambah Bidan</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Bidan</th>
                        <th scope="col">Nama Bidan</th>
                        <th scope="col">Nama Poli</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = $result->fetch_array()) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row["kode_bidan"]; ?></td>
                            <td><?= $row["nama_bidan"]; ?></td>
                            <td><?= $row["nama_poli"]; ?></td>
                            <td>
                                <a href="editbidan.php?kode_bidan=<?= $row["kode_bidan"] ?>"
                                    class="text-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="deletebidan.php?kode_bidan=<?= $row["kode_bidan"] ?>"
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