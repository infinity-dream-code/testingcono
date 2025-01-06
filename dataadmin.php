<?php 
session_start();

include 'header.php'; 
include 'koneksi.php';
?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
        <a href="tambahadmin.php" class="btn btn-primary btn-sm">+ Tambah Admin</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Admin</th>
                        <th>Nama Admin</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM admin";
                $exec = mysqli_query($conn, $query);
                if ($exec) {
                    while ($res = mysqli_fetch_assoc($exec)) {
                        echo "<tr>
                                <td>{$res['id']}</td>
                                <td>{$res['nama']}</td>
                                <td>{$res['username']}</td>
                                <td>{$res['password']}</td>
                                <td>{$res['role']}</td>
                                <td>
                                    <a href='editadmin.php?id={$res['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='hapusadmin.php?id={$res['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus admin ini?\")'>Hapus</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Error: " . mysqli_error($conn) . "</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
