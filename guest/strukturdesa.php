<?php
include '../connect.php';

$id_desa = 1;

$query = "
    SELECT sd.jabatan, w.nama_warga, sd.level
    FROM struktur_desa sd
    JOIN warga w ON sd.id_warga = w.id_warga
    WHERE sd.id_desa = $id_desa
    ORDER BY sd.level ASC, sd.id_struktur_desa ASC
";

$result = mysqli_query($conn, $query);

$perangkat = [];
while ($row = mysqli_fetch_assoc($result)) {
    $perangkat[$row['level']][] = $row;
}

$queryDesa = mysqli_query($conn, "SELECT * FROM desa WHERE id_desa = $id_desa");
$dataDesa = mysqli_fetch_assoc($queryDesa);

$queryLembaga = "
    SELECT 
        ld.*, 
        jl.nama_jenis, jl.warna, jl.ikon,
        al.nama AS nama_ketua, al.jabatan AS jabatan_ketua, al.kontak AS kontak_ketua
    FROM lembaga_desa ld
    JOIN jenis_lembaga jl ON ld.id_jenis = jl.id_jenis
    LEFT JOIN anggota_lembaga al 
        ON ld.id_anggota_lembaga = al.id_anggota_lembaga AND al.jabatan = 'Ketua'
    WHERE ld.id_desa = $id_desa AND ld.status = 'Aktif'
    ORDER BY jl.nama_jenis ASC
";

$resultLembaga = mysqli_query($conn, $queryLembaga);
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
            <h1 class="display-3 text-white mb-3 animated slideInDown">Struktur Perangkat Desa</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Profil</li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Struktur Perangkat Desa</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Konten -->
    <div class="container-fluid mt-3">

        <!-- Judul Halaman -->
        <h4 class="text-primary text-center mb-4">Struktur Perangkat Desa</h4>

        <!-- Bagian 1: Struktur Aparat Desa -->
        <div class="mb-5 p-4 bg-light rounded shadow-sm border">
            <h5 class="text-dark mb-3">
                <i class="fas fa-sitemap text-success me-2"></i>Struktur Organisasi Pemerintahan Desa
            </h5>
            <p class="mb-4">Struktur organisasi desa dengan relasi antar jabatan.</p>

            <div class="text-center mb-4">
                <img src="../assets/img/struktur-desa/<?= htmlspecialchars($dataDesa['foto_struktur']) ?>" alt="Struktur Aparat Desa" class="img-fluid rounded shadow-sm">
            </div>

            <h6 class="fw-bold mb-3 text-primary">Perangkat Desa</h6>
            <ul class="list-group">
                <?php foreach ($perangkat as $level => $jabatans) : ?>
                    <div class="row mb-3">
                        <?php
                        $count = count($jabatans);
                        $col = 12;
                        if ($count == 1) {
                            $col = 12;
                        } elseif ($count == 2) {
                            $col = 6;
                        } elseif ($count == 3) {
                            $col = 4;
                        } elseif ($count == 4) {
                            $col = 3;
                        } else {
                            $col = 3;
                        }
                        ?>
                        <?php foreach ($jabatans as $jabatan) : ?>
                            <div class="col-md-<?= $col ?>">
                                <div class="p-3 border rounded bg-white shadow-sm text-center">
                                    <strong class="text-primary"><?= htmlspecialchars($jabatan['jabatan']) ?></strong><br>
                                    <?= htmlspecialchars($jabatan['nama_warga']) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </ul>
        </div>


        <!-- Bagian 2: Struktur Kelembagaan Desa -->
        <div class="mb-5 p-4 bg-light rounded shadow-sm border">
            <h5 class="text-dark mb-3">
                <i class="fas fa-sitemap text-success me-2"></i>Struktur Kelembagaan Desa
            </h5>
            <p class="mb-4">Struktur kelembagaan desa mendukung penyelenggaraan pemerintahan dan pembangunan secara partisipatif:</p>
            <div class="row g-3">

                <?php while ($lembaga = mysqli_fetch_assoc($resultLembaga)) : ?>
                    <div class="col-md-6">
                        <div class="card border-<?= htmlspecialchars($lembaga['warna']) ?> shadow-sm h-100">
                            <div class="card-body">
                                <h6 class="text-<?= htmlspecialchars($lembaga['warna']) ?> fw-bold">
                                    <i class="<?= htmlspecialchars($lembaga['ikon']) ?> me-2"></i><?= htmlspecialchars($lembaga['nama_lembaga']) ?>
                                </h6>
                                <?php if (!empty($lembaga['deskripsi'])) : ?>
                                    <p class="mb-2" style="text-align: justify;">
                                        <?= htmlspecialchars($lembaga['deskripsi']) ?>
                                    </p>
                                <?php endif; ?>
                                <p class="mb-0">
                                    <strong>Ketua:</strong>
                                    <?= !empty($lembaga['nama_ketua'])
                                        ? htmlspecialchars($lembaga['nama_ketua']) . "<br><small>Kontak: {$lembaga['kontak_ketua']}</small>"
                                        : '<span class="text-muted">Belum ditetapkan</span>'
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

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