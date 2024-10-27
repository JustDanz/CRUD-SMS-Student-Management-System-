<?php
include 'db.php';
$message = ""; // Variabel untuk menyimpan pesan

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $jurusan = $_POST['jurusan'];
    $alamat = $_POST['alamat'];

    // Menyiapkan SQL untuk mencegah SQL Injection
    $stmt = $conn->prepare("INSERT INTO siswa (nama, jenis_kelamin, jurusan, alamat) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $jenis_kelamin, $jurusan, $alamat); // Menyusun parameter dengan tipe string

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success text-center mt-3' role='alert'>Siswa Telah Berhasil Registrasi</div>
                    <a href='read.php' class='btn btn-primary mt-2 btn-animated'>Lihat Daftar Siswa</a>";
    } else {
        $message = "<div class='alert alert-danger text-center mt-3' role='alert'>Gagal Registrasi: " . $stmt->error . "</div>";
    }

    $stmt->close(); // Menutup statement
    $conn->close(); // Menutup koneksi
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
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
        <h2 class="text-center">Daftarkan Siswa Baru</h2>
        <form method="post" action="create.php">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="" selected disabled>Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <select class="form-control" id="jurusan" name="jurusan" required>
                <option value="" disabled selected>Pilih Jurusan</option>
                <option value="RPL">Rekayasa Perangkat Lunak</option>
                <option value="Busana">Tata Busana</option>
                <option value="Hotel">Perhotelan</option>
                <option value="Boga">Tata Boga</option>
            </select>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-animated">Register</button>
        </form>

        <?php if ($message): ?>
            <div class="text-center mt-3">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-secondary btn-animated">Kembali ke Beranda</a>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap@4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
