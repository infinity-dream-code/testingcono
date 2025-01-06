<?php 
session_start();

include 'header.php'; 
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];
    $query = "SELECT * FROM kelas WHERE id_kelas = '$id_kelas'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Kelas tidak ditemukan!'); window.location.href='data_kelas.php';</script>";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];

    $query = "UPDATE kelas SET nama_kelas = '$nama_kelas' WHERE id_kelas = '$id_kelas'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Kelas berhasil diperbarui!'); window.location.href='datakelas.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Kelas</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="id_kelas">ID Kelas</label>
                    <input type="text" class="form-control" id="id_kelas" name="id_kelas" value="<?= $data['id_kelas']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?= $data['nama_kelas']; ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Perbarui Kelas</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
