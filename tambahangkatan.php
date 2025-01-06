<?php 
session_start();

include 'header.php'; 
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_angkatan = $_POST['nama_angkatan'];
    $biaya = $_POST['biaya'];

    $query = "INSERT INTO angkatan ( nama_angkatan, biaya) VALUES ( '$nama_angkatan', '$biaya')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Angkatan berhasil ditambahkan!'); window.location.href='dataangkatan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Angkatan</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                
                <div class="form-group">
                    <label for="nama_angkatan">Nama Angkatan</label>
                    <input type="text" class="form-control" id="nama_angkatan" name="nama_angkatan" required>
                </div>
                <div class="form-group">
                    <label for="biaya">Biaya</label>
                    <input type="number" class="form-control" id="biaya" name="biaya" required>
                </div>
                <button type="submit" class="btn btn-success">Tambah Angkatan</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
