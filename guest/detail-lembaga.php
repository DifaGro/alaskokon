<?php
include '../connect.php';

// Ambil ID lembaga dari parameter URL
$id_lembaga = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Query lembaga
$query = mysqli_query($conn, "
    SELECT 
        l.*,
        j.nama_jenis, j.warna, j.ikon,
        a.nama AS nama_ketua, a.jabatan AS jabatan_ketua, a.kontak AS kontak_ketua
    FROM lembaga_desa l
    LEFT JOIN jenis_lembaga j ON l.id_jenis = j.id_jenis
    LEFT JOIN anggota_lembaga a ON l.id_anggota_lembaga = a.id_anggota_lembaga
    WHERE l.id_lembaga = $id_lembaga
");
$data = mysqli_fetch_assoc($query);

// Query anggota lembaga
$queryAnggota = mysqli_query($conn, "
    SELECT * FROM anggota_lembaga 
    WHERE id_lembaga = $id_lembaga
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
</head>

<body>
    <!-- Spinner Start -->
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->
    <!-- Spinner End -->


    <!-- Topbar Start -->
    <?php include 'partials/topbar.php'; ?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <?php $page = 'lembaga'; ?>
    <?php include 'partials/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown"><?= htmlspecialchars($data['nama_lembaga']) ?></h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Potensi Desa</li>
                    <li class="breadcrumb-item text-white active" aria-current="page"><?= htmlspecialchars($data['nama_lembaga']) ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Konten -->
    <div class="container-fluid mt-3">
        <div class="p-4 bg-white border rounded shadow-sm">

            <!-- Judul dan Data Umum Lembaga -->
            <h4 class="text-primary mb-3">
                <i class="fas fa-users me-2"></i>
                Detail Lembaga Desa
            </h4>

            <div class="mb-3">
                <p><strong>Nama Lembaga:</strong> <?= !empty($data['nama_lembaga']) ? htmlspecialchars($data['nama_lembaga']) : '<span class="text-muted">Belum tersedia.</span>' ?></p>
                <p><strong>Jenis Lembaga:</strong> <?= !empty($data['nama_jenis']) ? htmlspecialchars($data['nama_jenis']) : '<span class="text-muted">Belum tersedia.</span>' ?></p>
                <p>
                    <strong>Ketua:</strong> <?= !empty($data['nama_ketua']) ? htmlspecialchars($data['nama_ketua']) : '<span class="text-muted">Belum tersedia.</span>' ?>
                </p>
                <p><strong>No HP:</strong> <?= !empty($data['no_hp']) ? htmlspecialchars($data['no_hp']) : '<span class="text-muted">Belum tersedia.</span>' ?></p>
                <p><strong>Email:</strong> <?= !empty($data['email']) ? htmlspecialchars($data['email']) : '<span class="text-muted">Belum tersedia.</span>' ?></p>
                <p><strong>Alamat:</strong> <?= !empty($data['alamat']) ? nl2br(htmlspecialchars($data['alamat'])) : '<span class="text-muted">Belum tersedia.</span>' ?></p>
                <p><strong>Status:</strong>
                    <span class="badge bg-<?= ($data['status'] == 'Aktif') ? 'success' : 'secondary' ?>">
                        <?= htmlspecialchars($data['status']) ?>
                    </span>
                </p>
                <p><strong>Tanggal Dibentuk:</strong> <?= !empty($data['tanggal_dibentuk']) ? htmlspecialchars($data['tanggal_dibentuk']) : '<span class="text-muted">Belum tersedia.</span>' ?></p>
            </div>

            <hr>

            <!-- Deskripsi -->
            <h5 class="text-secondary"><i class="fas fa-info-circle me-2"></i>Deskripsi Lembaga</h5>
            <div style="text-align: justify; line-height: 1.8; font-size: 1rem;">
                <?= !empty($data['deskripsi']) ? nl2br(htmlspecialchars($data['deskripsi'])) : '<span class="text-muted">Belum tersedia.</span>'; ?>
            </div>

            <hr>

            <!-- Anggota Lembaga -->
            <h5 class="text-secondary"><i class="fas fa-user-friends me-2"></i>Daftar Anggota</h5>
            <?php if (mysqli_num_rows($queryAnggota) > 0): ?>
                <ul class="list-unstyled">
                    <?php while ($row = mysqli_fetch_assoc($queryAnggota)): ?>
                        <li class="mb-2 d-flex justify-content-between border-bottom pb-2">
                            <div>
                                <strong><?= htmlspecialchars($row['jabatan']) ?> :</strong> <?= htmlspecialchars($row['nama']) ?>
                            </div>
                            <div class="text-end">
                                <?php if (!empty($row['kontak'])): ?>
                                    <i class="fas fa-phone-alt"></i> <?= htmlspecialchars($row['kontak']) ?>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">Belum ada anggota yang terdaftar.</p>
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