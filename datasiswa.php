<?php 
session_start();

include 'header.php'; 
include 'koneksi.php';
?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
        <a href="tambahsiswa.php" class="btn btn-primary btn-sm">+ Tambah Siswa</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Angkatan</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
               
                $query = "
                    SELECT siswa.nisn, siswa.nama, angkatan.nama_angkatan AS angkatan, kelas.nama_kelas AS kelas, jurusan.nama_jurusan AS jurusan, siswa.alamat
                    FROM siswa
                    JOIN angkatan ON siswa.id_angkatan = angkatan.id_angkatan
                    JOIN kelas ON siswa.id_kelas = kelas.id_kelas
                    JOIN jurusan ON siswa.id_jurusan = jurusan.id_jurusan
                ";
                $exec = mysqli_query($conn, $query);

                if ($exec) {
                    while ($res = mysqli_fetch_assoc($exec)) :
                ?>
                        <tr>
                            <td><?php echo $res['nisn']; ?></td>
                            <td><?php echo $res['nama']; ?></td>
                            <td><?php echo $res['angkatan']; ?></td>
                            <td><?php echo $res['kelas']; ?></td>
                            <td><?php echo $res['jurusan']; ?></td>
                            <td><?php echo $res['alamat']; ?></td>
                            <td>
                                <a href="editsiswa.php?id=<?php echo $res['nisn']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="hapussiswa.php?id=<?php echo $res['nisn']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
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
