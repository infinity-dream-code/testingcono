<?php 
session_start();

include 'header.php'; 
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $nama_kelas = $_POST['nama_kelas'];

    $query = "INSERT INTO kelas (nama_kelas) VALUES ( '$nama_kelas')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Kelas berhasil ditambahkan!'); window.location.href='datakelas.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Kelas</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                
                <div class="form-group">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" required>
                </div>
                <button type="submit" class="btn btn-success">Tambah Kelas</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
