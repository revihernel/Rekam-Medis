<?php
include "../koneksi.php";
include "item/menu.php";
$no = 1;
$sql = "SELECT * FROM tpoli ";
$result = $koneksi->query($sql);
?>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Data Poli</h2>
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary me-2" onclick="location.href='addpoli.php'">Tambah Poli</button>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode Poli</th>
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
                            <td><?= $row["kode_poli"]; ?></td>
                            <td><?= $row["nama_poli"]; ?></td>
                            <td>
                                <a href="editpoli.php?kode_poli=<?= $row["kode_poli"] ?>"
                                    class="text-warning">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="deletepoli.php?kode_poli=<?= $row["kode_poli"] ?>"
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