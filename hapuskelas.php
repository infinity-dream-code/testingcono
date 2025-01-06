<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];
    $query = "DELETE FROM kelas WHERE id_kelas = '$id_kelas'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Kelas berhasil dihapus!'); window.location.href='datakelas.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='datakelas.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='datakelas.php';</script>";
}
?>
