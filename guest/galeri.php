<?php
include '../connect.php';

$result = mysqli_query($conn, "
    SELECT a.id_artikel, a.judul_berita, a.jenis, a.tanggal_artikel, g.gambar, g.alt,
           YEAR(a.tanggal_artikel) AS tahun
    FROM artikel a 
    LEFT JOIN gambar_artikel g ON a.id_artikel = g.id_artikel 
    WHERE a.jenis != 'pengumuman'
    ORDER BY tahun DESC, a.tanggal_artikel DESC
");

$galeri = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tahun = $row['tahun'];
        $id = $row['id_artikel'];
        $judul = $row['judul_berita'];

        if (!isset($galeri[$tahun])) {
            $galeri[$tahun] = [];
        }

        if (!isset($galeri[$tahun][$id])) {
            $galeri[$tahun][$id] = [
                'judul' => $judul,
                'gambar' => [],
            ];
        }

        if (!empty($row['gambar'])) {
            $galeri[$tahun][$id]['gambar'][] = [
                'path' => "../assets/img/artikel/" . htmlspecialchars($row['gambar']),
                'alt' => htmlspecialchars($row['alt']),
            ];
        }
    }
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
    <div class="container-fluid mt-3">
        <div class="p-4 bg-white border rounded shadow-sm">
            <h4 class="text-primary mb-3">Galeri Desa</h4>

            <div class="mb-4">
                <input type="text" id="searchAgenda" class="form-control" placeholder="Cari Artikel...">
            </div>

            <div id="galeriContainer">
                <?php if (!empty($galeri)): ?>
                    <?php foreach ($galeri as $tahun => $items): ?>
                        <h5 class="mt-4 mb-3 text-secondary"><?= htmlspecialchars($tahun) ?></h5>
                        <div class="row">
                            <?php foreach ($items as $id => $data): ?>
                                <?php
                                $cover = !empty($data['gambar']) ? $data['gambar'][0]['path'] : '../assets/img/noimage.jpg';
                                ?>
                                <div class="col-md-4 mb-4 galeri-folder">
                                    <div class="card shadow-sm h-100">
                                        <a href="galeri-detail.php?id=<?= $id ?>" class="text-decoration-none text-dark">
                                            <img src="<?= $cover ?>" class="card-img-top" alt="<?= $data['judul'] ?>" style="height: 200px; object-fit: cover;">
                                            <div class="card-body">
                                                <h6 class="card-title"><?= htmlspecialchars($data['judul']) ?></h6>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Belum ada artikel yang memiliki galeri.</p>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchAgenda');
            const galeriItems = document.querySelectorAll('.galeri-folder');

            searchInput.addEventListener('keyup', function() {
                const query = this.value.toLowerCase();

                galeriItems.forEach(item => {
                    const title = item.querySelector('.card-title').textContent.toLowerCase();
                    item.style.display = title.includes(query) ? '' : 'none';
                });
            });
        });
    </script>
</body>

</html>