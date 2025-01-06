<?php
include 'koneksi.php';

if (isset($_GET['id_spp'])) {
    $id_spp = $_GET['id_spp'];
    $query = "DELETE FROM pembayaran WHERE id_spp = '$id_spp'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pembayaran berhasil dihapus!'); window.location.href='datapembayaran.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href='datapembayaran.php';</script>";
    }
} else {
    echo "<script>alert('ID SPP tidak ditemukan!'); window.location.href='datapembayaran.php';</script>";
}
?>
