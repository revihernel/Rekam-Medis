<?php
ob_start();
include "item/menu.php";
include "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_bidan = $_POST['kode_bidan'];
    $nama_bidan = $_POST['nama_bidan'];
    $kode_poli = $_POST['kode_poli'];
    $sql = "INSERT INTO tbidan (kode_bidan, nama_bidan, kode_poli)
            VALUES ('$kode_bidan', '$nama_bidan', '$kode_poli')";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: data_bidan.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $koneksi->error . "</div>";
    }
    $koneksi->close();
}
?>

<div class="container mt-2 mb-4">
    <div class="card-header text-black-bold mb-5">
        <h4 class="text-start ">Tambah Bidan</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="kode_bidan" class="form-label">Kode Bidan</label>
                <input type="text" class="form-control" id="kode_bidan" name="kode_bidan" required>
            </div>
            <div class="mb-3">
                <label for="nama_bidan" class="form-label">Nama Bidan</label>
                <input type="text" class="form-control" id="nama_bidan" name="nama_bidan" required>
            </div>
            <div class="mb-3">
                <label for="kode_poli" class="form-label">Pilih Poli</label>
                <select class="form-control" id="kode_poli" name="kode_poli" required>
                    <?php
                    $sql_poli = "SELECT kode_poli, nama_poli FROM tpoli";
                    $result_poli = $koneksi->query($sql_poli);

                    if ($result_poli->num_rows > 0) {
                        while($row_poli = $result_poli->fetch_assoc()) {
                            echo "<option value='" . $row_poli['kode_poli'] . "'>" . $row_poli['nama_poli'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada Poli tersedia</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success w-100">Simpan</button>
        </form>
    </div>
</div>
