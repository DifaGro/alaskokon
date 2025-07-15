<?php
session_start();
include '../connect.php';

// Jika user belum login, redirect ke login
if (!isset($_SESSION['id_warga'])) {
    header("Location: login.php");
    exit();
}
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
        form {
            border-radius: 1rem;
            background: #fff;
            padding: 2rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        form h2 {
            margin-bottom: 1.5rem;
        }
    </style>

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

    <!-- Form Ajukan Layanan Start -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <form action="proses-ajukan.php" method="POST" enctype="multipart/form-data">
                    <h2 class="text-center">Formulir Pengajuan Layanan</h2>

                    <div class="mb-3">
                        <label for="jenis_layanan" class="form-label">Pilih Jenis Layanan</label>
                        <select class="form-select" name="jenis_layanan" id="jenis_layanan" required>
                            <option value="">-- Pilih Layanan --</option>
                            <option value="KTP">Permohonan KTP</option>
                            <option value="KK">Permohonan KK</option>
                            <option value="Akta Kelahiran">Akta Kelahiran</option>
                            <option value="Surat Nikah">Surat Nikah</option>
                            <option value="Surat Keterangan">Surat Keterangan</option>
                            <option value="Surat Domisili">Surat Domisili</option>
                            <option value="Pengaduan Masyarakat">Pengaduan Masyarakat</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan Tambahan</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="4" placeholder="Tuliskan detail kebutuhan Anda..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="dokumen" class="form-label">Unggah Dokumen Pendukung (Opsional)</label>
                        <input class="form-control" type="file" name="dokumen" id="dokumen">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-paper-plane me-2"></i> Kirim Permohonan
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- Form Ajukan Layanan End -->

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