<?php 

session_start();


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit;
}

include 'header.php';
include 'koneksi.php';



$siswa_query = "SELECT COUNT(*) as total_siswa FROM siswa";
$siswa_result = mysqli_query($conn, $siswa_query);
$siswa_data = mysqli_fetch_assoc($siswa_result);
$total_siswa = $siswa_data['total_siswa'];

$bulan_ini = date('Y-m'); 
$pendapatan_query = "SELECT SUM(jumlah) as total_pendapatan FROM pembayaran WHERE DATE_FORMAT(tglbayar, '%Y-%m') = '$bulan_ini'";
$pendapatan_result = mysqli_query($conn, $pendapatan_query);
$pendapatan_data = mysqli_fetch_assoc($pendapatan_result);
$total_pendapatan = $pendapatan_data['total_pendapatan'];


$total_pendapatan = $total_pendapatan ? $total_pendapatan : 0;

?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Total Siswa Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Siswa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_siswa; ?> Siswa</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Pendapatan SPP Bulan Ini Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Pendapatan SPP Bulan Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            Rp <?php echo number_format($total_pendapatan, 0, ',', '.'); ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

  

</div>

<?php include 'footer.php'; ?>
