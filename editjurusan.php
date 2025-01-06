<?php 
session_start();

include 'header.php'; 
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_jurusan = $_GET['id'];
    $query = "SELECT * FROM jurusan WHERE id_jurusan = '$id_jurusan'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Jurusan tidak ditemukan!'); window.location.href='datajurusan.php';</script>";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_jurusan = $_POST['id_jurusan'];
    $nama_jurusan = $_POST['nama_jurusan'];

    $query = "UPDATE jurusan SET nama_jurusan = '$nama_jurusan' WHERE id_jurusan = '$id_jurusan'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Jurusan berhasil diperbarui!'); window.location.href='datajurusan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Jurusan</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="id_jurusan">ID Jurusan</label>
                    <input type="text" class="form-control" id="id_jurusan" name="id_jurusan" value="<?= $data['id_jurusan']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nama_jurusan">Nama Jurusan</label>
                    <input type="text" class="form-control" id="nama_jurusan" name="nama_jurusan" value="<?= $data['nama_jurusan']; ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Perbarui Jurusan</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
