<?php
ob_start();
include "item/menu.php";
include "../koneksi.php";

// Pastikan ada kode peserta yang dikirim via GET
if (isset($_GET['kode_peserta'])) {
    $kode_peserta = $_GET['kode_peserta'];

    // Ambil data peserta berdasarkan kode_peserta
    $sql = "SELECT * FROM tpeserta WHERE kode_peserta = '$kode_peserta'";
    $result = $koneksi->query($sql);

    // Jika data ditemukan, simpan ke variabel untuk form
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama_peserta = $row['nama_peserta'];
        $tanggal_lahir = $row['tanggal_lahir'];
        $jenis_kelamin = $row['jenis_kelamin'];
        $alamat = $row['alamat'];
        $telepon = $row['telepon'];
        $email = $row['email'];
    } else {
        echo "<div class='alert alert-danger'>Peserta tidak ditemukan!</div>";
    }
}

// Proses form submit untuk update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_peserta = $_POST['nama_peserta'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $email = $_POST['email'];

    $sql_update = "UPDATE tpeserta SET nama_peserta = '$nama_peserta', tanggal_lahir = '$tanggal_lahir', 
                  jenis_kelamin = '$jenis_kelamin', alamat = '$alamat', telepon = '$telepon', email = '$email' 
                  WHERE kode_peserta = '$kode_peserta'";

    if ($koneksi->query($sql_update) === TRUE) {
        // Redirect ke halaman data_peserta.php setelah berhasil update
        header("Location: data_peserta.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Error: " . $koneksi->error . "</div>";
    }
}

$koneksi->close();
?>
<div class="container mt-2 mb-4">
    <div class="card-header text-black-bold mb-5">
        <h4 class="text-start">Edit Peserta</h4>
    </div>
    <div class="card-body">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nama_peserta" class="form-label">Nama Peserta</label>
                <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" value="<?= $nama_peserta ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $tanggal_lahir ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?= ($jenis_kelamin == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="Perempuan" <?= ($jenis_kelamin == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?= $alamat ?></textarea>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $telepon ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>" required>
            </div>
            <button type="submit" class="btn btn-success w-100">Update</button>
        </form>
    </div>
</div>
