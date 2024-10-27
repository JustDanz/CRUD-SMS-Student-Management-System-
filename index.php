<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System (CRUD)</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        /* Animasi untuk judul */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .title {
            animation: fadeIn 1s ease-in-out;
        }

        /* Animasi untuk tombol */
        .btn-animated {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-animated:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-animated:active {
            transform: scale(0.95);
        }

        /* Pusatkan konten */
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="title">Student Management System Berbasis PHP</h2>
        <p>Selamat datang di sistem manajemen siswa. Anda dapat mendaftarkan siswa baru atau melihat daftar siswa yang telah terdaftar.</p>
        <div class="text-center">
            <a href="create.php" class="btn btn-primary btn-lg mx-2 btn-animated">Daftarkan Siswa Baru</a>
            <a href="read.php" class="btn btn-secondary btn-lg mx-2 btn-animated">Lihat Daftar Siswa</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
