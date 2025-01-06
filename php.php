<?php 
include 'header.php'; 
include 'koneksi.php';
?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
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
                    </tr>
                </thead>
                <tbody>
                <?php
                $query = "SELECT siswa.nisn, siswa.nama, angkatan.angkatan, kelas.kelas, jurusan.jurusan, siswa.alamat 
                          FROM siswa 
                          JOIN angkatan ON siswa.id_angkatan = angkatan.id_angkatan 
                          JOIN jurusan ON siswa.id_jurusan = jurusan.id_jurusan 
                          JOIN kelas ON siswa.id_kelas = kelas.id_kelas 
                          ORDER BY siswa.id_siswa";
                
                // Eksekusi query dan periksa apakah berhasil
                $exec = mysqli_query($conn, $query);
                
                if ($exec) {
                    // Periksa apakah ada data yang diambil
                    if (mysqli_num_rows($exec) > 0) {
                        while ($res = mysqli_fetch_assoc($exec)) {
                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($res['nisn']); ?></td>
                            <td><?php echo htmlspecialchars($res['nama']); ?></td>
                            <td><?php echo htmlspecialchars($res['angkatan']); ?></td>
                            <td><?php echo htmlspecialchars($res['kelas']); ?></td>
                            <td><?php echo htmlspecialchars($res['jurusan']); ?></td>
                            <td><?php echo htmlspecialchars($res['alamat']); ?></td>
                        </tr>
                <?php 
                        }
                    } else {
                        echo "<tr><td colspan='6'>Data tidak ditemukan.</td></tr>";
                    }
                } else {
                    // Tampilkan pesan error jika query gagal
                    echo "<tr><td colspan='6'>Error: " . mysqli_error($conn) . "</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>  
