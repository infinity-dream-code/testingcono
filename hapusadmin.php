<?php 
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM admin WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Admin berhasil dihapus!'); window.location.href='dataadmin.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='dataadmin.php';</script>";
    }
}
?>
