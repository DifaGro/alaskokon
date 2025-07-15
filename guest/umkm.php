<?php
include '../connect.php';

$id_desa = 1;

// Ambil halaman aktif & filter aktif
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$current_filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

$per_page = 9; // jumlah item per halaman
$offset = ($current_page - 1) * $per_page;

// Siapkan kondisi WHERE
$where = "WHERE u.id_desa = $id_desa";
if ($current_filter !== 'all') {
    // Misal filter = "makanan" → nama_jenis = "Makanan"
    $where .= " AND LOWER(REPLACE(ju.nama_jenis, ' ', '-')) = '" . mysqli_real_escape_string($conn, $current_filter) . "'";
}

// Hitung total sesuai filter
$total_umkm_result = mysqli_query($conn, "
  SELECT COUNT(*) AS total 
  FROM umkm u 
  JOIN jenis_umkm ju ON u.id_jenis_umkm = ju.id_jenis_umkm 
  $where
");
$total_umkm_row = mysqli_fetch_assoc($total_umkm_result);
$total_umkm = $total_umkm_row['total'];
$total_pages = ceil($total_umkm / $per_page);

// Query data UMKM sesuai filter + paging
$queryUmkm = "
  SELECT u.*, ju.nama_jenis 
  FROM umkm u
  JOIN jenis_umkm ju ON u.id_jenis_umkm = ju.id_jenis_umkm
  $where
  LIMIT $per_page OFFSET $offset
";
$resultUmkm = mysqli_query($conn, $queryUmkm);
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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
        #umkm-flters li {
            cursor: pointer;
            color: #555;
            transition: all 0.3s;
        }

        #umkm-flters li:hover {
            color: #008080;
            /* warna saat hover */
        }

        #umkm-flters li.active {
            color: #008080;
            /* warna aktif */
            font-weight: 600;
            border-bottom: 2px solid #008080;
            /* garis bawah aktif */
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
    <?php $page = 'potensi'; ?>
    <?php include 'partials/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Usaha Mikro, Kecil, dan Menengah</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Potensi Desa</li>
                    <li class="breadcrumb-item text-white active" aria-current="page">UMKM</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Konten -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="text-primary">UMKM</h6>
                <h1 class="mb-4">UMKM Unggulan Desa</h1>
            </div>
            <!-- Filter Start -->
            <div class="row mt-n2 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-12 text-center">
                    <ul class="list-inline mb-5 text-center" id="umkm-flters">
                        <li class="list-inline-item mx-2 <?= ($current_filter == 'all') ? 'active' : '' ?>" data-filter="*">
                            <a href="#" class="filter-umkm" data-filter="all">Semua</a>
                        </li>
                        <?php
                        $resultJenis = mysqli_query($conn, "SELECT * FROM jenis_umkm");
                        while ($jenis = mysqli_fetch_assoc($resultJenis)) :
                            $slug = strtolower(str_replace(' ', '-', $jenis['nama_jenis']));
                        ?>
                            <li class="list-inline-item mx-2 <?= ($current_filter == $slug) ? 'active' : '' ?>" data-filter=".<?= $slug ?>">
                                <a href="#" class="filter-umkm" data-filter="<?= $slug ?>"><?= htmlspecialchars($jenis['nama_jenis']) ?></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
            <!-- Filter End -->
            <div id="umkm-list" class="row g-4 mt-3">
                <?php while ($umkm = mysqli_fetch_assoc($resultUmkm)) : ?>
                    <div class="col-lg-4 col-md-6 portfolio-item <?= strtolower(str_replace(' ', '-', $umkm['nama_jenis'])) ?> wow fadeInUp">
                        <div class="team-item rounded overflow-hidden mt-2">
                            <div class="d-flex">
                                <img class="img-fluid w-75"
                                    src="../assets/img/umkm/<?= htmlspecialchars($umkm['foto']) ?>"
                                    alt="<?= htmlspecialchars($umkm['nama_umkm']) ?>"
                                    style="height: 250px; object-fit: cover;">
                                <div class="team-social w-25">
                                    <?php if (!empty($umkm['link_tiktok'])) : ?>
                                        <a class="btn btn-lg-square btn-outline-primary rounded-circle mt-3"
                                            href="<?= htmlspecialchars($umkm['link_tiktok']) ?>" target="_blank">
                                            <i class="fab fa-tiktok"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty($umkm['link_instagram'])) : ?>
                                        <a class="btn btn-lg-square btn-outline-primary rounded-circle mt-3"
                                            href="<?= htmlspecialchars($umkm['link_instagram']) ?>" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty($umkm['no_hp'])) : ?>
                                        <a class="btn btn-lg-square btn-outline-primary rounded-circle mt-3"
                                            href="https://wa.me/<?= htmlspecialchars($umkm['no_hp']) ?>" target="_blank">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (!empty($umkm['link_website'])) : ?>
                                        <a class="btn btn-lg-square btn-outline-primary rounded-circle mt-3"
                                            href="<?= htmlspecialchars($umkm['link_website']) ?>" target="_blank">
                                            <i class="fas fa-globe"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="p-4 d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1"><?= htmlspecialchars($umkm['nama_umkm']) ?></h5>
                                    <small class="text-muted"><?= htmlspecialchars($umkm['nama_jenis']) ?></small>
                                </div>
                                <button
                                    class="btn btn-sm btn-outline-primary rounded-circle btn-detail-umkm"
                                    data-nama="<?= htmlspecialchars($umkm['nama_umkm']) ?>"
                                    data-deskripsi="<?= htmlspecialchars($umkm['deskripsi']) ?>"
                                    data-alamat="<?= htmlspecialchars($umkm['alamat']) ?>"
                                    title="Detail UMKM">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Pesan jika kosong -->
            <div class="row g-4 mt-3">
                <?php if (mysqli_num_rows($resultUmkm) > 0): ?>
                    <?php while ($umkm = mysqli_fetch_assoc($resultUmkm)) : ?>
                        <!-- ITEM UMKM -->
                    <?php endwhile; ?>
                <?php else: ?>
                    <div id="umkm-empty" class="text-center mt-4">
                        <h5 class="text-muted">Belum ada UMKM pada kategori ini.</h5>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <div id="umkm-pagination" class="text-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php if ($current_page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="?filter=<?= $current_filter ?>&page=<?= $current_page - 1 ?>">« Prev</a>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                <a href="#" class="page-link" data-page="<?= $i ?>"><?= $i ?></a>
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

        </div>
    </div>

    <!-- Modal Detail UMKM -->
    <div class="modal fade" id="umkmDetailModal" tabindex="-1" aria-labelledby="umkmDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="umkmDetailModalLabel">Detail UMKM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <h5 id="modalNamaUmkm"></h5>
                    <p id="modalDeskripsiUmkm"></p>
                    <p><strong>Alamat:</strong> <span id="modalAlamatUmkm"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <?php include 'partials/footer.php'; ?>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/lib/wow/wow.min.js"></script>
    <script src="../assets/lib/easing/easing.min.js"></script>
    <script src="../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/counterup/counterup.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../assets/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="../assets/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Isotope -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>

    <script>
        $(document).ready(function() {

            function loadUmkm(filter, page) {
                $.ajax({
                    url: 'get_umkm.php',
                    method: 'GET',
                    data: {
                        filter: filter,
                        page: page
                    },
                    success: function(response) {
                        // Buat response cuma potongan
                        $('#umkm-list').html($(response).filter('#umkm-list').html());
                        $('#umkm-pagination').html($(response).filter('#umkm-pagination').html());

                        // Update filter aktif
                        $('#umkm-flters li').removeClass('active');
                        $('#umkm-flters li').each(function() {
                            if ($(this).find('a').data('filter') == filter) {
                                $(this).addClass('active');
                            }
                        });
                    }
                });
            }

            // Klik filter
            $(document).on('click', '.filter-umkm', function(e) {
                e.preventDefault();
                var filter = $(this).data('filter');
                loadUmkm(filter, 1);
            });

            // Klik pagination
            $(document).on('click', '#umkm-pagination .page-link', function(e) {
                e.preventDefault();
                var page = $(this).data('page');
                var filter = $('#umkm-flters li.active a').data('filter') || 'all';
                loadUmkm(filter, page);
            });

            // Tombol detail tetap jalan
            $(document).on('click', '.btn-detail-umkm', function() {
                var nama = $(this).data('nama');
                var deskripsi = $(this).data('deskripsi');
                var alamat = $(this).data('alamat');

                Swal.fire({
                    title: nama,
                    html: `<p>${deskripsi}</p><p><strong>Alamat:</strong> ${alamat}</p>`,
                    icon: 'info',
                    confirmButtonText: 'Tutup'
                });
            });

        });
    </script>

</body>

</html>