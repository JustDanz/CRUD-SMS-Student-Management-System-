<?php
include 'db.php';

$message = ""; // Variabel untuk menyimpan pesan

if (isset($_GET['id_siswa'])) {
    $id_siswa = $_GET['id_siswa'];

    // Step 1: Delete the student record
    $sql = "DELETE FROM siswa WHERE id_siswa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_siswa);

    if ($stmt->execute()) {
        $message = "Data Berhasil DI Hapus";

        // Step 2: Adjust IDs
        $sql = "SET @count = 0; 
                UPDATE siswa SET id_siswa = @count := @count + 1 
                ORDER BY id_siswa;";
        
        if ($conn->multi_query($sql)) {
            do {
                // Store first result set
                if ($result = $conn->store_result()) {
                    $result->free();
                }
            } while ($conn->next_result());
            $message .= " ID Siswa Telah Di Sesuaikan.";
        } else {
            $message .= " Gagal Mengatur ID Siswa: " . $conn->error;
        }
    } else {
        $message = "Gagal Melakukan Penghapusan Data: " . $stmt->error;
    }

    $stmt->close(); // Close the statement
}

$conn->close(); // Close the connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Siswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Hapus Siswa</h2>
        <div class="text-center mt-3">
            <?php if ($message): ?>
                <div class="alert alert-info"><?php echo $message; ?></div>
            <?php endif; ?>
        </div>
        <div class="text-center mt-4">
            <a href="read.php" class="btn btn-primary">Kembali ke Daftar Siswa</a>
            <a href="index.php" class="btn btn-secondary">Kembali ke Beranda</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
