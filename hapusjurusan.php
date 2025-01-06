<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_jurusan = $_GET['id'];
    $query = "DELETE FROM jurusan WHERE id_jurusan = '$id_jurusan'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Jurusan berhasil dihapus!'); window.location.href='datajurusan.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='datajurusan.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan!'); window.location.href='data_jurusan.php';</script>";
}
?>
