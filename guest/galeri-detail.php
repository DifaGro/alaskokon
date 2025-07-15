<?php
include '../connect.php';

$id_artikel = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data artikel dan gambar-gambarnya
$query = mysqli_query($conn, "
    SELECT a.judul_berita, g.gambar, g.alt 
    FROM artikel a 
    LEFT JOIN gambar_artikel g ON a.id_artikel = g.id_artikel 
    WHERE a.id_artikel = $id_artikel
");

$judul = '';
$gambarList = [];

if ($query && mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $judul = $row['judul_berita'];

        if (!empty($row['gambar'])) {
            $gambarList[] = [
                'path' => "../assets/img/artikel/" . htmlspecialchars($row['gambar']),
                'alt' => htmlspecialchars($row['alt'])
            ];
        }
    }
} else {
    header("Location: galeri.php");
    exit;
}
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

    <style>
        .galeri-item img {
            height: 200px;
            object-fit: cover;
            width: 100%;
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
    <?php $page = 'kabar'; ?>
    <?php include 'partials/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Galeri</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Kabar Desa</li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Galeri</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Konten Galeri -->
    <div class="container mt-5">
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="galeri.php" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center shadow-sm mt-1" title="Kembali ke Galeri Utama">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h3 class="mb-0 text-primary">Galeri: <?= htmlspecialchars($judul) ?></h3>
        </div>

        <?php if (!empty($gambarList)): ?>
            <div class="row">
                <?php foreach ($gambarList as $g): ?>
                    <div class="col-md-4 col-sm-6 galeri-item mb-4 text-center">
                        <a href="<?= $g['path'] ?>" data-lightbox="galeri-<?= $id_artikel ?>" data-title="<?= $g['alt'] ?>">
                            <img src="<?= $g['path'] ?>" alt="<?= $g['alt'] ?>" class="img-fluid rounded shadow-sm">
                        </a>
                        <a href="<?= $g['path'] ?>" download class="btn btn-sm btn-outline-primary mt-2">
                            <i class="fas fa-download"></i> Unduh
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-muted">Belum ada gambar pada artikel ini.</p>
        <?php endif; ?>
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