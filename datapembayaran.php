<?php 
session_start();

include 'header.php'; 
include 'koneksi.php';
?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID SPP</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th> <!-- Tambahkan kolom NISN -->
                        <th>Keterangan</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Angkatan</th>
                        <th>Jumlah</th>
                        <th>Tanggal Bayar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                // Query untuk mengambil data pembayaran dengan NISN
                $query = "SELECT 
                            pembayaran.id_spp, 
                            siswa.nama, 
                            siswa.nisn,  -- Tambahkan nisn di sini
                            pembayaran.ket, 
                            kelas.nama_kelas, 
                            jurusan.nama_jurusan, 
                            angkatan.nama_angkatan, 
                            pembayaran.jumlah, 
                            pembayaran.tglbayar 
                          FROM pembayaran 
                          JOIN siswa ON pembayaran.id_siswa = siswa.id_siswa
                          JOIN kelas ON siswa.id_kelas = kelas.id_kelas
                          JOIN jurusan ON siswa.id_jurusan = jurusan.id_jurusan
                          JOIN angkatan ON siswa.id_angkatan = angkatan.id_angkatan";

                $exec = mysqli_query($conn, $query);

                if ($exec) {
                    while ($res = mysqli_fetch_assoc($exec)) :
                ?>
                        <tr>
                            <td><?php echo $res['id_spp']; ?></td>
                            <td><?php echo $res['nama']; ?></td>
                            <td><?php echo $res['nisn']; ?></td> <!-- Tampilkan NISN -->
                            <td><?php echo $res['ket']; ?></td>
                            <td><?php echo $res['nama_kelas']; ?></td>
                            <td><?php echo $res['nama_jurusan']; ?></td>
                            <td><?php echo $res['nama_angkatan']; ?></td>
                            <td><?php echo "RP ". number_format($res['jumlah'], 0, ',', '.'); ?></td>
                            <td><?php echo date('d-m-Y', strtotime($res['tglbayar'])); ?></td>
                            <td>
                                <a href="hapuspembayaran.php?id_spp=<?php echo $res['id_spp']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pembayaran ini?');">Hapus</a>
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
