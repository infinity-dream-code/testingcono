<?php 
session_start();

include 'header.php'; 
include 'koneksi.php';
?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Jurusan</h6>
        <a href="tambahjurusan.php" class="btn btn-primary btn-sm">+ Tambah Jurusan</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID Jurusan</th>
                        <th>Nama Jurusan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT * FROM jurusan";
                $exec = mysqli_query($conn, $query);

                if ($exec) {
                    while ($res = mysqli_fetch_assoc($exec)) :
                ?>
                        <tr>
                            <td><?php echo $res['id_jurusan']; ?></td>
                            <td><?php echo $res['nama_jurusan']; ?></td>
                            <td>
                                <a href="editjurusan.php?id=<?php echo $res['id_jurusan']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapusjurusan.php?id=<?php echo $res['id_jurusan']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
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
