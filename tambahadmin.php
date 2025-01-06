<?php
session_start();

include 'header.php';
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "INSERT INTO admin (nama, username, password, role) VALUES ('$nama', '$username', '$password','$role')";
    if (mysqli_query($conn, $query)) {
        echo "<div class='alert alert-success'>Data Admin berhasil ditambahkan!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Admin</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="nama">Nama Admin</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Admin" required>
                </div>
                <div class="form-group">
                    <label for="username">username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <input type="text" class="form-control" id="role" name="role" placeholder="Masukkan role" required>
                </div>
                <button type="submit" class="btn btn-success">Tambah Admin</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
