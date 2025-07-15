<?php
include '../connect.php';

// Query data lembaga dari tabel `lembaga_desa`
$result = mysqli_query($conn, "
    SELECT 
        ld.*,
        al.nama AS nama_ketua
    FROM lembaga_desa ld
    LEFT JOIN anggota_lembaga al ON ld.id_anggota_lembaga = al.id_anggota_lembaga AND al.jabatan = 'Ketua'
    ORDER BY ld.nama_lembaga ASC
");
$lembagas = [];
while ($row = mysqli_fetch_assoc($result)) {
    $lembagas[] = $row;
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
        .text-justify {
            text-align: justify;
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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Lembaga Desa</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Potensi Desa</li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Lembaga</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Konten -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 600px;">
                <h6 class="text-primary">Lembaga</h6>
                <h1 class="mb-4">Daftar Lembaga Desa</h1>
            </div>
            <div class="row g-4">
                <?php if (count($lembagas) > 0): ?>
                    <?php foreach ($lembagas as $lembaga): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 border border-primary rounded-2 shadow-sm d-flex flex-column">
                                <div class="card-body flex-grow-1 d-flex flex-column">
                                    <h5 class="card-title text-primary"><?= htmlspecialchars($lembaga['nama_lembaga']) ?></h5>
                                    <p class="mb-2">
                                        <strong>Ketua:</strong>
                                        <?= !empty($lembaga['nama_ketua']) ? htmlspecialchars($lembaga['nama_ketua']) : '<span class="text-muted">Belum ditetapkan</span>' ?>
                                    </p>

                                    <?php if (!empty($lembaga['deskripsi'])): ?>
                                        <p class="mb-2 text-justify"><?= htmlspecialchars($lembaga['deskripsi']) ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($lembaga['alamat'])): ?>
                                        <p class="mb-2"><strong>Alamat:</strong> <?= htmlspecialchars($lembaga['alamat']) ?></p>
                                    <?php endif; ?>

                                    <!-- Tombol di bawah -->
                                    <div class="mt-auto pt-3 d-flex gap-2">
                                        <?php if (!empty($lembaga['no_hp'])): ?>
                                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $lembaga['no_hp']) ?>"
                                                target="_blank"
                                                class="btn btn-sm btn-success"
                                                title="Chat WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (!empty($lembaga['email'])): ?>
                                            <button type="button"
                                                class="btn btn-sm btn-secondary btn-email"
                                                data-email="<?= htmlspecialchars($lembaga['email']) ?>"
                                                title="Lihat Email">
                                                <i class="fa fa-envelope"></i>
                                            </button>
                                        <?php endif; ?>

                                        <a href="detail-lembaga.php?id=<?= $lembaga['id_lembaga'] ?>"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fa fa-eye"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Belum ada data lembaga.</p>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailButtons = document.querySelectorAll('.btn-email');
            emailButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    const email = this.getAttribute('data-email');
                    Swal.fire({
                        title: 'Email Lembaga',
                        text: email,
                        icon: 'info',
                        confirmButtonText: 'Tutup'
                    });
                });
            });
        });
    </script>
</body>

</html>