<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_angkatan = $_GET['id'];
    $query = "DELETE FROM angkatan WHERE id_angkatan = '$id_angkatan'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Angkatan berhasil dihapus!'); window.location.href='dataangkatan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='data_angkatan.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='dataangkatan.php';</script>";
}
?>
