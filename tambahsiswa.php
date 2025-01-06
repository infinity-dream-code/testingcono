<?php 
session_start();

include 'header.php'; 
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $id_angkatan = $_POST['id_angkatan'];
    $id_kelas = $_POST['id_kelas'];
    $id_jurusan = $_POST['id_jurusan'];
    $alamat = $_POST['alamat'];

    $query = "INSERT INTO siswa (nisn, nama, id_angkatan, id_kelas, id_jurusan, alamat) 
              VALUES ('$nisn', '$nama', '$id_angkatan', '$id_kelas', '$id_jurusan', '$alamat')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Siswa berhasil ditambahkan!'); window.location.href='datasiswa.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Siswa</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="nisn">NIS</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="id_angkatan">Angkatan</label>
                    <select class="form-control" id="id_angkatan" name="id_angkatan" required>
                        <option value="">Pilih Angkatan</option>
                        <?php
                        // Ambil data angkatan dari database
                        $angkatanQuery = "SELECT * FROM angkatan";
                        $angkatanResult = mysqli_query($conn, $angkatanQuery);
                        while ($angkatan = mysqli_fetch_assoc($angkatanResult)) {
                            echo "<option value='{$angkatan['id_angkatan']}'>{$angkatan['nama_angkatan']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_kelas">Kelas</label>
                    <select class="form-control" id="id_kelas" name="id_kelas" required>
                        <option value="">Pilih Kelas</option>
                        <?php
                        // Ambil data kelas dari database
                        $kelasQuery = "SELECT * FROM kelas";
                        $kelasResult = mysqli_query($conn, $kelasQuery);
                        while ($kelas = mysqli_fetch_assoc($kelasResult)) {
                            echo "<option value='{$kelas['id_kelas']}'>{$kelas['nama_kelas']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_jurusan">Jurusan</label>
                    <select class="form-control" id="id_jurusan" name="id_jurusan" required>
                        <option value="">Pilih Jurusan</option>
                        <?php
                        // Ambil data jurusan dari database
                        $jurusanQuery = "SELECT * FROM jurusan";
                        $jurusanResult = mysqli_query($conn, $jurusanQuery);
                        while ($jurusan = mysqli_fetch_assoc($jurusanResult)) {
                            echo "<option value='{$jurusan['id_jurusan']}'>{$jurusan['nama_jurusan']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>
                <button type="submit" class="btn btn-success">Tambah Siswa</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
