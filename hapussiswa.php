<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $nisn = $_GET['id'];
    $query = "DELETE FROM siswa WHERE nisn = '$nisn'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Siswa berhasil dihapus!'); window.location.href='datasiswa.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='datasiswa.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='datasiswa.php';</script>";
}
?>
