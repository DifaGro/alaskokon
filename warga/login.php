<?php
session_start();
include '../connect.php';

if (!isset($_SESSION['loginStatus'])) {
    $_SESSION['loginStatus'] = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $pin = trim($_POST['pin']);

    if (empty($username) || empty($pin)) {
        $_SESSION['loginStatus'] = "empty";
        header("Location: login.php");
        exit();
    } else {
        $query = mysqli_query($conn, "SELECT * FROM warga WHERE id_warga = '$username' AND pin = '$pin' LIMIT 1");
        if (mysqli_num_rows($query) > 0) {
            $data = mysqli_fetch_assoc($query);
            $_SESSION['id_warga'] = $data['id_warga'];
            $_SESSION['username'] = $data['username'];

            $_SESSION['loginStatus'] = "success";
            header("Location: dashboard.php"); 
            exit();
        } else {
            $_SESSION['loginStatus'] = "failed";
            header("Location: login.php");
            exit();
        }
    }
}

$loginStatus = $_SESSION['loginStatus'];
$_SESSION['loginStatus'] = "";
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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">

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

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out both;
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
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="min-height: 85vh;">
    <div class="container m-5 fade-in">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form id="loginForm" method="POST" action="">
                    <h2 class="text-light mb-4 text-center">Login</h2>

                    <div class="form-group">
                        <input type="text" class="form-control mb-3" name="username" placeholder="Masukkan Username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control mb-4" name="pin" placeholder="Masukkan PIN">
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                        <button type="submit" class="btn btn-outline-light btn-custom order-1 order-md-2">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                        <a href="../guest/index.php" class="btn btn-outline-danger btn-custom order-2 order-md-1">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <p class="text-light text-center mt-3" style="font-size: 0.9rem;">
                        <i class="fas fa-info-circle"></i> Pengguna baru dapat menghubungi perangkat desa untuk mendapatkan <strong>PIN</strong>.
                    </p>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        <?php if ($loginStatus === "empty"): ?>
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text: 'Username dan PIN tidak boleh kosong!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        <?php elseif ($loginStatus === "failed"): ?>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: 'Username atau PIN salah!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    </script>

</body>

</html>