<?php
include '../connect.php';

// Konfigurasi
$per_page = 6;
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

$offset = ($current_page - 1) * $per_page;

// Siapkan kondisi filter
$where = "";
if ($current_filter != 'all') {
    $where = "WHERE jenis = '" . mysqli_real_escape_string($conn, $current_filter) . "'";
}

// Hitung total
$total_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM artikel $where");
$total_row = mysqli_fetch_assoc($total_query);
$total_artikel = $total_row['total'];
$total_pages = ceil($total_artikel / $per_page);

// Ambil data
$query = mysqli_query($conn, "
    SELECT * 
    FROM artikel a
    LEFT JOIN gambar_artikel g ON g.id_gambar_artikel = (
        SELECT id_gambar_artikel FROM gambar_artikel 
        WHERE gambar_artikel.id_artikel = a.id_artikel 
        ORDER BY id_gambar_artikel ASC LIMIT 1
    )
    $where
    ORDER BY tanggal_artikel DESC
    LIMIT $per_page OFFSET $offset
");
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
        /* Sembunyikan tombol default-nya */
        .portfolio-btn {
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        /* Hover untuk layar desktop */
        @media (min-width: 768px) {
            .portfolio-img:hover .portfolio-btn {
                opacity: 1;
                pointer-events: auto;
            }
        }

        .portfolio-img .portfolio-btn {
            opacity: 0;
            transition: 0.3s;
            pointer-events: none;
        }

        .portfolio-img.active .portfolio-btn {
            opacity: 1;
            pointer-events: auto;
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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Berita Desa</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Kabar Desa</li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Berita Desa</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Projects Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="text-primary">Berita Desa</h6>
                <h1 class="mb-4">Desa Kita, Cerita Kita</h1>
            </div>
            <div class="row mt-n2 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-12 text-center">
                    <ul class="list-inline mb-5" id="portfolio-flters">
                        <li class="mx-2 <?= ($current_filter == 'all') ? 'active' : '' ?>">
                            <a href="?filter=all">Semua</a>
                        </li>
                        <li class="mx-2 <?= ($current_filter == 'Berita') ? 'active' : '' ?>">
                            <a href="?filter=Berita">Berita</a>
                        </li>
                        <li class="mx-2 <?= ($current_filter == 'Pengumuman') ? 'active' : '' ?>">
                            <a href="?filter=Pengumuman">Pengumuman</a>
                        </li>
                        <li class="mx-2 <?= ($current_filter == 'Hasil Agenda') ? 'active' : '' ?>">
                            <a href="?filter=Hasil Agenda">Hasil Agenda</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row g-4 portfolio-container wow fadeInUp" data-wow-delay="0.5s">
                <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                    <?php
                    // Tentukan class filter berdasar jenis
                    if ($row['jenis'] == 'Berita') {
                        $filter = 'first';
                    } elseif ($row['jenis'] == 'Pengumuman') {
                        $filter = 'second';
                    } elseif ($row['jenis'] == 'Hasil Agenda') {
                        $filter = 'third';
                    } else {
                        $filter = '';
                    }
                    ?>
                    <div class="col-lg-4 col-md-6 portfolio-item <?= $filter ?>">
                        <div class="portfolio-img rounded overflow-hidden" style="height: 250px;">
                            <img class="img-fluid w-100 h-100" src="../assets/img/artikel/<?= $row['gambar'] ?>" alt="<?= $row['alt'] ?>" style="object-fit: cover;">
                            <div class="portfolio-btn">
                                <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="detailberita.php?id=<?= $row['id_artikel'] ?>" title="Lihat Detail Berita">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="javascript:void(0);" onclick="copyLink('<?= $row['link'] ?>')">
                                    <i class="fa fa-link"></i>
                                </a>
                            </div>
                        </div>
                        <div class="pt-3">
                            <h5 class="lh-base mb-2"><?= $row['judul_berita'] ?></h5>
                            <div class="d-flex align-items-center small text-muted">
                                <img src="../assets/img/user.png" class="rounded-circle me-2" style="width: 25px; height: 25px; object-fit: cover;" alt="User">
                                <span class="me-3"><?= $row['author'] ?></span>
                                <i class="fa fa-calendar me-1"></i>
                                <span><?= date('d M Y', strtotime($row['tanggal_artikel'])) ?></span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Pagination Start -->
            <div id="pagination" class="text-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($current_page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?filter=<?= $current_filter ?>&page=<?= $current_page - 1 ?>">« Prev</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                <a class="page-link" href="?filter=<?= $current_filter ?>&page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <?php if ($current_page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="?filter=<?= $current_filter ?>&page=<?= $current_page + 1 ?>">Next »</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
            <!-- Pagination End -->

        </div>
    </div>
    <!-- Projects End -->




    <!-- Footer Start -->
    <?php include 'partials/footer.php'; ?>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        function copyLink(link) {
            if (!link || link.trim() === "") {
                Swal.fire({
                    title: 'Tidak Ada Link',
                    text: 'Artikel ini tidak memiliki link.',
                    icon: 'warning',
                    confirmButtonText: 'Tutup'
                });
                return;
            }

            navigator.clipboard.writeText(link).then(function() {
                Swal.fire({
                    title: 'Link Disalin!',
                    text: link,
                    icon: 'success',
                    confirmButtonText: 'Oke',
                    timer: 3000,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false
                });
            }, function(err) {
                Swal.fire({
                    title: 'Gagal Menyalin!',
                    text: err,
                    icon: 'error',
                    confirmButtonText: 'Tutup'
                });
            });
        }

        function isMobile() {
            return window.innerWidth <= 768;
        }

        // Tangani klik gambar
        document.querySelectorAll('.portfolio-img').forEach(function(img) {
            img.addEventListener('click', function(e) {
                if (isMobile()) {
                    e.stopPropagation();

                    // Jika sudah aktif → tutup
                    if (img.classList.contains('active')) {
                        img.classList.remove('active');
                    } else {
                        // Tutup semua yang lain
                        document.querySelectorAll('.portfolio-img.active').forEach(function(el) {
                            el.classList.remove('active');
                        });
                        // Aktifkan yang ini
                        img.classList.add('active');
                    }
                }
            });
        });

        // Klik luar gambar → tutup semua
        document.addEventListener('click', function(e) {
            if (isMobile() && !e.target.closest('.portfolio-img')) {
                document.querySelectorAll('.portfolio-img.active').forEach(function(el) {
                    el.classList.remove('active');
                });
            }
        });
    </script>
</body>

</html>