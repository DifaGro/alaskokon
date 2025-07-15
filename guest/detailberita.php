<?php
include '../connect.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query artikel
$artikel = mysqli_query($conn, "SELECT * FROM artikel WHERE id_artikel = $id");
$data = mysqli_fetch_assoc($artikel);

if (!$data) {
    echo "<h2>Berita tidak ditemukan!</h2>";
    exit;
}

// Buat nama cookie unik per artikel
$cookie_name = "artikel_" . $id . "_viewed";
// Hitung expire cookie sampai jam 23:59:59 hari ini
$expire = strtotime('tomorrow') - time();

// Jika cookie belum ada, tambah views
if (!isset($_COOKIE[$cookie_name])) {
    mysqli_query($conn, "UPDATE artikel SET views = views + 1 WHERE id_artikel = $id");
    setcookie($cookie_name, 'sudah', time() + $expire, "/", "", false, true);
}

// Ambil ulang data untuk views terbaru
$artikel = mysqli_query($conn, "SELECT * FROM artikel WHERE id_artikel = $id");
$data = mysqli_fetch_assoc($artikel);

// Query gambar
$gambar = mysqli_query($conn, "SELECT * FROM gambar_artikel WHERE id_artikel = $id");
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
    <?php $page = 'kabar'; ?>
    <?php include 'partials/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown"><?= $data['judul_berita'] ?></h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Kabar Desa</li>
                    <li class="breadcrumb-item text-white" aria-current="page"><a class="text-white" href="berita.php">Berita Desa</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page"><?= $data['judul_berita'] ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Konten Detail Berita -->
    <div class="container mb-5">
        <div class="p-4 bg-white border rounded shadow-sm">

            <!-- Carousel -->
            <div id="carouselBerita" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $active = true;
                    while ($row = mysqli_fetch_assoc($gambar)) :
                    ?>
                        <div class="carousel-item <?= $active ? 'active' : '' ?>">
                            <img src="../assets/img/artikel/<?= $row['gambar'] ?>" class="d-block w-100 rounded" style="height:500px; object-fit: contain; background: #f0f0f0;" alt="<?= htmlspecialchars($row['alt']) ?>">
                        </div>
                    <?php
                        $active = false;
                    endwhile;
                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselBerita" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselBerita" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                </button>
            </div>

            <!-- Judul & Info -->
            <h2 class="text-primary mb-2"><?= htmlspecialchars($data['judul_berita']) ?></h2>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <img src="../assets/img/user.png" alt="Penulis" class="rounded-circle me-2" style="width:40px; height:40px; object-fit:cover;">
                    <strong><?= htmlspecialchars($data['author'] ?? 'Admin Desa') ?></strong>
                </div>
                <div class="text-end">
                    <small class="text-muted d-block">
                        <i class="fas fa-eye me-1"></i> Dilihat <?= number_format($data['views']) ?> kali
                    </small>
                    <small class="text-muted fs-6">
                        <i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($data['tanggal_artikel'])) ?>
                    </small>
                </div>
            </div>

            <!-- Paragraf -->
            <div class="mt-3" style="text-align: justify;">
                <?= nl2br($data['paragraf']) ?>

                <?php if (!empty($data['link'])) : ?>
                    <p class="mt-3">
                        <strong>Link terkait:</strong><br>
                        <a href="<?= $data['link'] ?>" target="_blank"><?= $data['link'] ?></a>
                    </p>
                <?php else : ?>
                    <p class="mt-3 text-danger">
                        <em>Artikel ini tidak memiliki link terkait.</em>
                    </p>
                <?php endif; ?>
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