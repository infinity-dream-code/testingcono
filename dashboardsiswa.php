<?php
session_start();

include 'koneksi.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'siswa') {
    header('Location: index.php');
    exit;
}

$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Pengguna';

$querySiswa = "SELECT id_siswa FROM siswa WHERE nama = '$nama'";
$resultSiswa = mysqli_query($conn, $querySiswa);
$rowSiswa = mysqli_fetch_assoc($resultSiswa);
$id_siswa = $rowSiswa['id_siswa'] ?? null;

if (!$id_siswa) {
    die("Siswa tidak ditemukan.");
}

$bulan_ini = date('F');
$tahun_ini = date('Y');

$queryCek = "SELECT COUNT(*) AS jumlah FROM pembayaran WHERE id_siswa = '$id_siswa' AND bulan = '$bulan_ini' AND YEAR(jatuhtempo) = '$tahun_ini'";
$resultCek = mysqli_query($conn, $queryCek);
$rowCek = mysqli_fetch_assoc($resultCek);
$sudah_bayar = $rowCek['jumlah'] > 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$sudah_bayar) {
   
    $jatuh_tempo = mysqli_real_escape_string($conn, $_POST['jatuh_tempo']);
    $jumlah = mysqli_real_escape_string($conn, $_POST['jumlah']);
    $ket = mysqli_real_escape_string($conn, $_POST['ket']);

    $queryAdmin = "SELECT id FROM admin WHERE nama = '$nama'";
    $resultAdmin = mysqli_query($conn, $queryAdmin);
    $rowAdmin = mysqli_fetch_assoc($resultAdmin);
    $id_admin = $rowAdmin['id'] ?? null;

    if (!$id_admin) {
        die("Admin tidak ditemukan.");
    }

    $queryLastId = "SELECT MAX(id_spp) AS last_id FROM pembayaran";
    $resultLastId = mysqli_query($conn, $queryLastId);
    $rowLastId = mysqli_fetch_assoc($resultLastId);
    $lastId = $rowLastId['last_id'] ?? 0;

    $nobayar = "NOBYR-" . ($lastId + 1);

    $queryInsert = "INSERT INTO pembayaran ( id_siswa, jatuhtempo, bulan, jumlah, ket, id_admin, tglbayar, nobayar) 
                    VALUES ('$id_siswa', '$jatuh_tempo', '$bulan_ini', '$jumlah', '$ket', '$id_admin', NOW(), '$nobayar')";
    mysqli_query($conn, $queryInsert);

    header("Location: dashboardsiswa.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white text-center">
                <h3>Selamat Datang, <?php echo htmlspecialchars($nama); ?>!</h3>
            </div>
            <div class="card-body">
                <?php if ($sudah_bayar): ?>
                    <p class="text-success">Kamu sudah membayar SPP untuk bulan ini!</p>
                <?php else: ?>
                    <h5>Form Pembayaran</h5>
                    <form method="POST">
                        
                        <div class="mb-3">
                            <label for="jatuh_tempo" class="form-label">Jatuh Tempo</label>
                            <input type="date" name="jatuh_tempo" id="jatuh_tempo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="ket" class="form-label">Keterangan</label>
                            <textarea name="ket" id="ket" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Bayar</button>
                    </form>
                <?php endif; ?>
                <hr>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
</body>
</html>
