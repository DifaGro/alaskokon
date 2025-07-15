<?php
session_start();
include '../connect.php';

// Jika user belum login, redirect ke login
if (!isset($_SESSION['id_warga'])) {
    header("Location: login.php");
    exit();
}

// Cek status login sukses untuk SweetAlert
$loginStatus = isset($_SESSION['loginStatus']) ? $_SESSION['loginStatus'] : "";
$_SESSION['loginStatus'] = "";
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Layanan Mandiri || Sistem Informasi Website Desa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="../assets/img/logo.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="../assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../assets/css/style.css" rel="stylesheet">

    <style>
        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 1rem;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .service-icon-box {
            border-radius: 1rem;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <?php include 'partials/topbar.php'; ?>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <?php $page = 'layanan'; ?>
    <?php include 'partials/navbar.php'; ?>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Layanan Mandiri</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Layanan Mandiri</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Daftar Layanan Start -->
    <div class="d-flex flex-wrap justify-content-start gap-4" style="max-width: 1540px; margin: auto;">

        <!-- Pengaduan -->
        <a href="ajukan-layanan.php" class="text-decoration-none">
            <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
                <div class="me-4">
                    <div class="service-icon-box" style="background-color: #ffe0b2;">
                        <i class="fas fa-exclamation-circle fa-2x text-warning"></i>
                    </div>
                </div>
                <div>
                    <h6 class="fw-bold mb-1 m-0 text-dark">Pengaduan Masyarakat</h6>
                    <p class="text-muted mb-0">Laporkan masalah, keluhan, atau aspirasi Anda</p>
                </div>
            </div>
        </a>

        <!-- Permohonan KTP -->
        <a href="ajukan-layanan.php" class="text-decoration-none">
            <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
                <div class="me-4">
                    <div class="service-icon-box" style="background-color: #e3f2fd;">
                        <i class="fas fa-scroll fa-2x text-primary"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold mb-1 m-0 text-dark">Permohonan KTP</h5>
                    <p class="text-muted mb-0">Ajukan pembuatan atau perpanjangan KTP secara online</p>
                </div>
            </div>
        </a>

        <!-- Permohonan KK -->
        <a href="ajukan-layanan.php" class="text-decoration-none">
            <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
                <div class="me-4">
                    <div class="service-icon-box" style="background-color: #fce4ec;">
                        <i class="fas fa-scroll fa-2x text-danger"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold mb-1 m-0 text-dark">Permohonan KK</h5>
                    <p class="text-muted mb-0">Pengajuan Kartu Keluarga baru atau perubahan data</p>
                </div>
            </div>
        </a>

        <!-- Akta Kelahiran -->
        <a href="ajukan-layanan.php" class="text-decoration-none">
            <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
                <div class="me-4">
                    <div class="service-icon-box" style="background-color: #fff3e0;">
                        <i class="fas fa-scroll fa-2x text-warning"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold mb-1 m-0 text-dark">Akta Kelahiran</h5>
                    <p class="text-muted mb-0">Pendaftaran akta kelahiran anak secara daring</p>
                </div>
            </div>
        </a>

        <!-- Surat Nikah -->
        <a href="ajukan-layanan.php" class="text-decoration-none">
            <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
                <div class="me-4">
                    <div class="service-icon-box" style="background-color: #e8f5e9;">
                        <i class="fas fa-scroll fa-2x text-success"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold mb-1 m-0 text-dark">Surat Nikah</h5>
                    <p class="text-muted mb-0">Pengajuan surat pengantar nikah</p>
                </div>
            </div>
        </a>

        <!-- Surat Keterangan -->
        <a href="ajukan-layanan.php" class="text-decoration-none">
            <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
                <div class="me-4">
                    <div class="service-icon-box" style="background-color: #ede7f6;">
                        <i class="fas fa-scroll fa-2x text-secondary"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold mb-1 m-0 text-dark">Surat Keterangan</h5>
                    <p class="text-muted mb-0">Permohonan berbagai surat keterangan</p>
                </div>
            </div>
        </a>

        <!-- Surat Domisili -->
        <a href="ajukan-layanan.php" class="text-decoration-none">
            <div class="d-flex align-items-center bg-white p-4 shadow service-card" style="width: 360px;">
                <div class="me-4">
                    <div class="service-icon-box" style="background-color: #fffde7;">
                        <i class="fas fa-scroll fa-2x text-warning"></i>
                    </div>
                </div>
                <div>
                    <h5 class="fw-bold mb-1 m-0 text-dark">Surat Domisili</h5>
                    <p class="text-muted mb-0">Pengajuan surat domisili untuk keperluan administrasi</p>
                </div>
            </div>
        </a>

        <!-- Tombol Lanjut -->
        <div class="container-fluid px-0 mt-5">
            <div class="row gx-0">
                <div class="col-12">
                    <a href="ajukan-layanan.php"
                        class="btn btn-primary w-100 py-3 px-4 fw-semibold d-flex align-items-center justify-content-center shadow-lg"
                        style="border-radius: 50px; font-size: 1.25rem; transition: all 0.3s ease;">
                        <i class="fas fa-paper-plane me-3"></i> Ajukan Layanan Sekarang
                    </a>
                </div>
            </div>
        </div>

    </div>
    <!-- Daftar Layanan End -->


    <!-- Footer Start -->
    <?php include 'partials/footer.php'; ?>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/lib/wow/wow.min.js"></script>
    <script src="../assets/lib/easing/easing.min.js"></script>
    <script src="../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/counterup/counterup.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../assets/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="../assets/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>
</body>

</html>