<?php
ob_start();
include "item/menu.php";
include "../koneksi.php";

// Mengecek apakah parameter kode_bidan ada di URL
if (isset($_GET['kode_bidan'])) {
    $kode_bidan = $_GET['kode_bidan'];

    // Query untuk mengambil data bidan berdasarkan kode_bidan
    $sql_bidan = "SELECT * FROM tbidan WHERE kode_bidan = '$kode_bidan'";
    $result_bidan = $koneksi->query($sql_bidan);

    // Mengecek apakah data ditemukan
    if ($result_bidan->num_rows > 0) {
        // Mengambil data bidan
        $row_bidan = $result_bidan->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Bidan tidak ditemukan!</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>Kode Bidan tidak tersedia!</div>";
    exit;
}

// Mengecek apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_bidan = $_POST['kode_bidan'];
    $nama_bidan = $_POST['nama_bidan'];
    $kode_poli = $_POST['kode_poli'];

    // Query untuk update data bidan
    $sql_update = "UPDATE tbidan SET nama_bidan = '$nama_bidan', kode_poli = '$kode_poli' WHERE kode_bidan = '$kode_bidan'";

    if ($koneksi->query($sql_update) === TRUE) {
        // Jika berhasil, arahkan ke halaman data_bidan.php
        header("Location: data_bidan.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $koneksi->error . "</div>";
    }

    // Menutup koneksi
    $koneksi->close();
}
?>

<div class="container mt-2 mb-4">
    <div class="card-header text-black-bold mb-5 align-start">
        <h4 class="bold">Edit Bidan</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <!-- Input untuk Kode Bidan (Read-only) -->
            <div class="mb-3">
                <label for="kode_bidan" class="form-label">Kode Bidan</label>
                <input type="text" class="form-control" id="kode_bidan" name="kode_bidan" value="<?php echo $row_bidan['kode_bidan']; ?>" readonly>
            </div>
            <!-- Input untuk Nama Bidan -->
            <div class="mb-3">
                <label for="nama_bidan" class="form-label">Nama Bidan</label>
                <input type="text" class="form-control" id="nama_bidan" name="nama_bidan" value="<?php echo $row_bidan['nama_bidan']; ?>" required>
            </div>
            <!-- Dropdown untuk memilih Poli -->
            <div class="mb-3">
                <label for="kode_poli" class="form-label">Pilih Poli</label>
                <select class="form-control" id="kode_poli" name="kode_poli" required>
                    <?php
                    // Query untuk mengambil data poli
                    $sql_poli = "SELECT kode_poli, nama_poli FROM tpoli";
                    $result_poli = $koneksi->query($sql_poli);

                    if ($result_poli->num_rows > 0) {
                        // Menampilkan setiap pilihan Poli
                        while($row_poli = $result_poli->fetch_assoc()) {
                            $selected = ($row_bidan['kode_poli'] == $row_poli['kode_poli']) ? "selected" : "";
                            echo "<option value='" . $row_poli['kode_poli'] . "' $selected>" . $row_poli['nama_poli'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada Poli tersedia</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Tombol untuk mengirim data -->
            <button type="submit" class="btn btn-success w-100">Simpan Perubahan</button>
        </form>
    </div>
</div>
