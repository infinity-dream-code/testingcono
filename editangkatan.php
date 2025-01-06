<?php 
session_start();

include 'header.php'; 
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_angkatan = $_GET['id'];
    $query = "SELECT * FROM angkatan WHERE id_angkatan = '$id_angkatan'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Angkatan tidak ditemukan!'); window.location.href='dataangkatan.php';</script>";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_angkatan = $_POST['id_angkatan'];
    $nama_angkatan = $_POST['nama_angkatan'];
    $biaya = $_POST['biaya'];

    $query = "UPDATE angkatan SET nama_angkatan = '$nama_angkatan', biaya = '$biaya' WHERE id_angkatan = '$id_angkatan'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Angkatan berhasil diperbarui!'); window.location.href='dataangkatan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Angkatan</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="id_angkatan">ID Angkatan</label>
                    <input type="text" class="form-control" id="id_angkatan" name="id_angkatan" value="<?= $data['id_angkatan']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nama_angkatan">Nama Angkatan</label>
                    <input type="text" class="form-control" id="nama_angkatan" name="nama_angkatan" value="<?= $data['nama_angkatan']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="biaya">Biaya</label>
                    <input type="number" class="form-control" id="biaya" name="biaya" value="<?= $data['biaya']; ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Perbarui Angkatan</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
