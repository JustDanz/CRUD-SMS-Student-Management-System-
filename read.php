<?php
include 'db.php';

$sql = "SELECT id_siswa, nama, jenis_kelamin, jurusan, alamat FROM siswa";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
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
        <h2 class="text-center">Daftar Siswa</h2>
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1; ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['jenis_kelamin']; ?></td>
                            <td><?php echo $row['jurusan']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td>
                                <a href="update.php?id_siswa=<?php echo $row['id_siswa']; ?>" class="btn btn-warning btn-sm btn-animated">Edit</a>
                                <a href="delete.php?id_siswa=<?php echo $row['id_siswa']; ?>" class="btn btn-danger btn-sm btn-animated" onclick="return confirm('Anda yakin ingin menghapus siswa ini?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Siswa Tidak Ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="text-center mb-4">
            <a href="create.php" class="btn btn-primary btn-animated">Daftarkan Siswa Baru</a>
            <a href="index.php" class="btn btn-secondary btn-animated">Kembali ke Beranda</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
