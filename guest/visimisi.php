<?php
include '../connect.php';

// Ambil id_desa
$id_desa = 1;

// Ambil data desa
$queryDesa = mysqli_query($conn, "SELECT visi FROM desa WHERE id_desa = $id_desa");
$dataDesa = mysqli_fetch_assoc($queryDesa);

// Ambil data misi
$queryMisi = mysqli_query($conn, "SELECT isi FROM misi WHERE id_desa = $id_desa");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Sistem Informasi Website Desa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

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
    <?php $page = 'profil'; ?>
    <?php include 'partials/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Visi & Misi</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Profil</li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Visi & Misi</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Konten -->
    <div class="container-fluid mt-3">
        <!-- Gambar Header -->
        <div class="mb-4">
            <img src="../assets/img/visimisi.png" alt="Visi Misi Desa" class="img-fluid w-100 rounded shadow-sm" style="max-height: 500px; object-fit: cover;">
        </div>

        <!-- 2 Card: Visi dan Misi -->
        <div class="row g-4">
            <!-- Card Visi -->
            <div class="col-lg-6">
                <div class="card border-primary shadow-sm h-100">
                    <div class="card-header bg-primary text-white fw-bold fs-5">VISI</div>
                    <div class="card-body">
                        <p class="card-text fs-5">
                            <?= !empty($dataDesa['visi'])
                                ? htmlspecialchars($dataDesa['visi'])
                                : '<span class="text-muted">Informasi visi belum tersedia pada sistem.</span>'; ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card Misi -->
            <div class="col-lg-6">
                <div class="card border-success shadow-sm h-100">
                    <div class="card-header bg-success text-white fw-bold fs-5">MISI</div>
                    <div class="card-body">
                        <?php if (mysqli_num_rows($queryMisi) > 0): ?>
                            <ul class="fs-6 mb-0">
                                <?php while ($misi = mysqli_fetch_assoc($queryMisi)): ?>
                                    <li class="mb-2"><?= htmlspecialchars($misi['isi']); ?></li>
                                <?php endwhile; ?>
                            </ul>
                        <?php else: ?>
                            <p class="text-muted">Informasi misi belum tersedia pada sistem.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

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