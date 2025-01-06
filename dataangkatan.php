<?php 
session_start();

include 'header.php'; 
include 'koneksi.php';
?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Angkatan</h6>
        <a href="tambahangkatan.php" class="btn btn-primary btn-sm">+ Tambah Angkatan</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Angkatan</th>
                        <th>Nama Angkatan</th>
                        <th>Biaya</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM angkatan";
                $exec = mysqli_query($conn, $query);

                if ($exec) {
                    while ($res = mysqli_fetch_assoc($exec)) :
                ?>
                        <tr>
                            <td><?php echo $res['id_angkatan']; ?></td>
                            <td><?php echo $res['nama_angkatan']; ?></td>
                            <td><?php echo number_format($res['biaya'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="editangkatan.php?id=<?php echo $res['id_angkatan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapusangkatan.php?id=<?php echo $res['id_angkatan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                <?php 
                    endwhile;
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
