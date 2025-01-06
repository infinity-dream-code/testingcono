<?php 
session_start();
include 'header.php'; 
include 'koneksi.php';

if (isset($_GET['id'])) {
    $nisn = $_GET['id'];
    $query = "SELECT * FROM siswa WHERE nisn = '$nisn'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Siswa tidak ditemukan!'); window.location.href='datasiswa.php';</script>";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $id_angkatan = $_POST['id_angkatan'];
    $id_kelas = $_POST['id_kelas'];
    $id_jurusan = $_POST['id_jurusan'];
    $alamat = $_POST['alamat'];

    $query = "UPDATE siswa SET nama = '$nama', id_angkatan = '$id_angkatan', id_kelas = '$id_kelas', id_jurusan = '$id_jurusan', alamat = '$alamat' WHERE nisn = '$nisn'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Siswa berhasil diperbarui!'); window.location.href='datasiswa.php';</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Siswa</h4>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="nisn">NIS</label>
                    <input type="text" class="form-control" id="nisn" name="nisn" value="<?= $data['nisn']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama']; ?>" required>
                </div>

                <!-- Angkatan Dropdown -->
                <div class="form-group">
                    <label for="id_angkatan">Angkatan</label>
                    <select class="form-control" id="id_angkatan" name="id_angkatan" required>
                        <?php
                        $angkatanQuery = "SELECT * FROM angkatan";
                        $angkatanResult = mysqli_query($conn, $angkatanQuery);
                        while ($angkatan = mysqli_fetch_assoc($angkatanResult)) {
                            $selected = ($angkatan['id_angkatan'] == $data['id_angkatan']) ? 'selected' : '';
                            echo "<option value='{$angkatan['id_angkatan']}' $selected>{$angkatan['nama_angkatan']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Kelas Dropdown -->
                <div class="form-group">
                    <label for="id_kelas">Kelas</label>
                    <select class="form-control" id="id_kelas" name="id_kelas" required>
                        <?php
                        $kelasQuery = "SELECT * FROM kelas";
                        $kelasResult = mysqli_query($conn, $kelasQuery);
                        while ($kelas = mysqli_fetch_assoc($kelasResult)) {
                            $selected = ($kelas['id_kelas'] == $data['id_kelas']) ? 'selected' : '';
                            echo "<option value='{$kelas['id_kelas']}' $selected>{$kelas['nama_kelas']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Jurusan Dropdown -->
                <div class="form-group">
                    <label for="id_jurusan">Jurusan</label>
                    <select class="form-control" id="id_jurusan" name="id_jurusan" required>
                        <?php
                        $jurusanQuery = "SELECT * FROM jurusan";
                        $jurusanResult = mysqli_query($conn, $jurusanQuery);
                        while ($jurusan = mysqli_fetch_assoc($jurusanResult)) {
                            $selected = ($jurusan['id_jurusan'] == $data['id_jurusan']) ? 'selected' : '';
                            echo "<option value='{$jurusan['id_jurusan']}' $selected>{$jurusan['nama_jurusan']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $data['alamat']; ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Perbarui Siswa</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
