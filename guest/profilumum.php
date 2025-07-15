<?php
include '../connect.php';

$id_desa = 1;
$query = mysqli_query($conn, "SELECT * FROM desa WHERE id_desa = $id_desa");
$data = mysqli_fetch_assoc($query);

// Ambil data fasilitas
$queryFasilitas = mysqli_query($conn, "SELECT fasilitas FROM fasilitas WHERE id_desa = $id_desa");

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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Profil Desa <?= $data['nama_desa']; ?></h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Profil</li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Profil Umum</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Konten -->
    <div class="container-fluid mt-3">
        <div class="p-4 bg-white border rounded shadow-sm">

            <!-- Gambar Header Profil -->
            <div class="mb-4">
                <img src="../assets/img/profildesa.png" alt="Kantor Desa" class="img-fluid w-100 rounded shadow-sm" style="max-height: 500px; object-fit: cover;">
            </div>

            <!-- Judul dan Data Umum -->
            <h4 class="text-primary mb-3"><i class="fas fa-map-marker-alt me-2"></i>Profil Umum Desa</h4>

            <div class="mb-3">
                <p><strong>Desa:</strong> <?= !empty($data['nama_desa']) ? 'Desa ' . htmlspecialchars($data['nama_desa']) : '<span class="text-muted">Informasi ini belum tersedia pada sistem.</span>' ?></p>
                <p><strong>Kecamatan:</strong> <?= !empty($data['kecamatan']) ? 'Kecamatan ' . htmlspecialchars($data['kecamatan']) : '<span class="text-muted">Informasi ini belum tersedia pada sistem.</span>' ?></p>
                <p><strong>Kabupaten:</strong> <?= !empty($data['kabupaten']) ? 'Kabupaten ' . htmlspecialchars($data['kabupaten']) : '<span class="text-muted">Informasi ini belum tersedia pada sistem.</span>' ?></p>
                <p><strong>Provinsi:</strong> <?= !empty($data['provinsi']) ? 'Provinsi ' . htmlspecialchars($data['provinsi']) : '<span class="text-muted">Informasi ini belum tersedia pada sistem.</span>' ?></p>
                <p><strong>Luas Wilayah:</strong> <?= !empty($data['luas_wilayah']) ? htmlspecialchars($data['luas_wilayah']) . ' km²' : '<span class="text-muted">Informasi ini belum tersedia pada sistem.</span>' ?></p>
            </div>

            <hr>

            <!-- Sejarah Desa -->
            <h5 class="text-secondary"><i class="fas fa-history me-2"></i>Sejarah Desa</h5>
            <div style="text-align: justify; text-justify: inter-word; line-height: 1.8; font-size: 1rem;">
                <?= !empty($data['sejarah'])
                    ? nl2br(htmlspecialchars($data['sejarah']))
                    : '<span class="text-muted">Informasi ini belum tersedia pada sistem.</span>'; ?>
            </div>

            <hr>

            <!-- Fasilitas Umum -->
            <h5 class="text-secondary"><i class="fas fa-tools me-2"></i>Fasilitas Umum</h5>
            <?php if (mysqli_num_rows($queryFasilitas) > 0): ?>
                <ul class="list-unstyled">
                    <?php while ($row = mysqli_fetch_assoc($queryFasilitas)): ?>
                        <li class="mb-2 d-flex align-items-center">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <?= htmlspecialchars($row['fasilitas']); ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">Informasi fasilitas belum tersedia pada sistem.</p>
            <?php endif; ?>

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