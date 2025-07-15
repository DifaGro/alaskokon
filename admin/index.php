<?php
session_start();
include '../connect.php';

if (isset($_POST['login'])) {
    $id_petugas = $_POST['id_petugas'];
    $pin_input = $_POST['pin'];

    $query = "SELECT * FROM petugas WHERE id_petugas = '$id_petugas'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $data = mysqli_fetch_assoc($result);
        if (password_verify($pin_input, $data['pin'])) {
            $_SESSION['id_petugas'] = $data['id_petugas'];
            $_SESSION['level'] = $data['level'];
            $_SESSION['success'] = "Login berhasil! Selamat datang, " . $data['level'];
            header("Location: dashboard.php");
            exit;
        } else {
            $_SESSION['error'] = "PIN salah!";
            header("Location: index.php");
            exit;
        }
    } else {
        $_SESSION['error'] = "ID Petugas tidak ditemukan!";
        header("Location: index.php");
        exit;
    }
}

// Ambil pesan error kalau ada
$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login || Sistem Informasi Website Desa</title>

    <link href="../assets/img/logo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@1,500&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Exo 2', sans-serif;
        }

        body {
            background: url('../assets/img/bg.png') center/cover no-repeat fixed;
            min-height: 100vh;
        }

        #loginForm {
            border: 1px solid #ffffff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #ddd;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.6);
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .btn-custom {
            width: 100%;
        }

        @media (min-width: 768px) {
            .btn-custom {
                width: 48%;
            }
        }

        .btn i {
            margin-right: 6px;
        }

        a.btn {
            text-align: left;
        }

        h2 {
            font-weight: bold;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="min-height: 85vh;">
    <div class="container m-5 fade-in">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form id="loginForm" method="POST" action="">
                    <div class="text-center mb-3">
                        <img src="../assets/img/logo.png" alt="Logo Desa" style="width: 80px; height: auto;">
                    </div>
                    <h2 class="text-light mb-4 text-center">Login</h2>
                    <p class="text-light mb-4 text-center">Halo, Petugas! Login untuk mengelola data desa.</p>

                    <div class="form-group">
                        <input type="text" class="form-control mb-3" name="id_petugas" placeholder="Masukkan ID Petugas">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control mb-4" name="pin" placeholder="Masukkan PIN">
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="login" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Validasi field kosong
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            var idPetugas = document.querySelector('[name="id_petugas"]').value.trim();
            var pin = document.querySelector('[name="pin"]').value.trim();

            if (idPetugas === '' || pin === '') {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'ID Petugas dan PIN wajib diisi!'
                });
            }
        });

        <?php if ($error != '') : ?>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '<?= htmlspecialchars($error) ?>'
            });
        <?php endif; ?>
    </script>
</body>

</html>