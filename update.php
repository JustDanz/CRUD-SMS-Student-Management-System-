<?php
include 'db.php';

if (isset($_GET['id_siswa'])) {  // Memastikan parameter GET 'id_siswa' ada
    $id_siswa = $_GET['id_siswa'];  // Ambil id_siswa dari URL

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form
        $nama = $_POST['nama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $jurusan = $_POST['jurusan'];
        $alamat = $_POST['alamat'];

        // Update data siswa berdasarkan id_siswa
        $sql = "UPDATE siswa SET nama='$nama', jenis_kelamin='$jenis_kelamin', jurusan='$jurusan', alamat='$alamat' WHERE id_siswa=$id_siswa";

        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success text-center' role='alert'>Data Siswa Berhasil Di Update</div>";
        } else {
            echo "<div class='alert alert-danger text-center' role='alert'>Error updating: " . $conn->error . "</div>";
        }
    }

    // Ambil data siswa berdasarkan id_siswa untuk ditampilkan di form
    $sql = "SELECT * FROM siswa WHERE id_siswa=$id_siswa";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();  // Ambil data siswa
    } else {
        echo "<div class='alert alert-danger text-center' role='alert'>Siswa tidak ditemukan</div>";
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        /* Animasi untuk tombol */
        .btn-animated {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-animated:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Student</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($student['nama']); ?>" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="Laki-laki" <?php echo $student['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="Perempuan" <?php echo $student['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?php echo htmlspecialchars($student['jurusan']); ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($student['alamat']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-animated">Update</button>
        </form>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary btn-animated">Kembali ke Beranda</a>
            <a href="read.php" class="btn btn-info btn-animated">Lihat Daftar Siswa</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap@4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
} else {
    echo "<div class='alert alert-danger text-center' role='alert'>Invalid ID</div>";
}
$conn->close();
?>
