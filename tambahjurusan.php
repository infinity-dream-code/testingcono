<?php 
session_start();

include 'header.php'; 
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $nama_jurusan = $_POST['nama_jurusan'];

    $query = "INSERT INTO jurusan ( nama_jurusan) VALUES ('$nama_jurusan')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Jurusan berhasil ditambahkan!'); window.location.href='datajurusan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Jurusan</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                
                <div class="form-group">
                    <label for="nama_jurusan">Nama Jurusan</label>
                    <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" required>
                </div>
                <button type="submit" class="btn btn-success">Tambah Jurusan</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
