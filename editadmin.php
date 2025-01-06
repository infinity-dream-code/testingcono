<?php 
session_start();

include 'header.php'; 
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM admin WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Admin tidak ditemukan!'); window.location.href='dataadmin.php';</script>";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $updateQuery = "UPDATE admin SET nama = '$nama', username = '$username', password = '$password', role = '$role' WHERE id = '$id'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Data Admin berhasil diperbarui!'); window.location.href='dataadmin.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $data['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?= $data['password']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="role">role</label>
                    <input type="role" class="form-control" id="role" name="role" value="<?= $data['role']; ?>" required>
                </div>

                <button type="submit" class="btn btn-success">Perbarui Admin</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
