<?php
include "../connect.php"; // Koneksi ke database

// Ambil data desa
$datadesa = mysqli_query($conn, "SELECT * FROM `desa` WHERE id_desa = 1");
$desa = mysqli_fetch_assoc($datadesa);

$id_desa = 1;
$tanggal_hari_ini = date('Y-m-d');
$cookie_name = "kunjungan_" . $id_desa . "_" . $tanggal_hari_ini;

// Hitung kunjungan unik harian dengan cookie
if (!isset($_COOKIE[$cookie_name])) {
    $cek = mysqli_query($conn, "SELECT * FROM statistik_pengunjung WHERE id_desa = $id_desa AND tanggal = '$tanggal_hari_ini'");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($conn, "UPDATE statistik_pengunjung SET jumlah = jumlah + 1 WHERE id_desa = $id_desa AND tanggal = '$tanggal_hari_ini'");
    } else {
        mysqli_query($conn, "INSERT INTO statistik_pengunjung (id_desa, tanggal, jumlah) VALUES ($id_desa, '$tanggal_hari_ini', 1)");
    }

    // Set cookie sampai jam 00:00 besok
    $midnight = strtotime('tomorrow midnight');
    $expire = $midnight - time();
    setcookie($cookie_name, 'sudah', time() + $expire, "/");
}

// Data statistik pengunjung
$today = date('Y-m-d');
$yesterday = date('Y-m-d', strtotime('-1 day'));
$bulan_ini = date('Y-m');
$tahun_ini = date('Y');

$hari_ini = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as total FROM statistik_pengunjung WHERE id_desa=$id_desa AND tanggal = '$today'"))['total'] ?? 0;
$kemarin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as total FROM statistik_pengunjung WHERE id_desa=$id_desa AND tanggal = '$yesterday'"))['total'] ?? 0;
$bulan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as total FROM statistik_pengunjung WHERE id_desa=$id_desa AND DATE_FORMAT(tanggal, '%Y-%m') = '$bulan_ini'"))['total'] ?? 0;
$tahun = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as total FROM statistik_pengunjung WHERE id_desa=$id_desa AND YEAR(tanggal) = '$tahun_ini'"))['total'] ?? 0;
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as total FROM statistik_pengunjung WHERE id_desa=$id_desa"))['total'] ?? 0;

// Ambil data kepala desa
$queryKepalaDesa = mysqli_query($conn, "
    SELECT w.*
    FROM struktur_desa sd
    JOIN warga w ON sd.id_warga = w.id_warga
    WHERE sd.id_desa = $id_desa AND sd.jabatan = 'Kepala Desa'
    LIMIT 1
");
$dataKepalaDesa = mysqli_fetch_assoc($queryKepalaDesa);

// Ambil 7 berita terbaru
$queryBerita = mysqli_query($conn, "
    SELECT * 
    FROM artikel a
    LEFT JOIN gambar_artikel g ON g.id_gambar_artikel = (
        SELECT id_gambar_artikel FROM gambar_artikel 
        WHERE gambar_artikel.id_artikel = a.id_artikel 
        ORDER BY id_gambar_artikel ASC LIMIT 1
    )
    ORDER BY a.tanggal_artikel DESC
    LIMIT 7
");

// Ambil 6 berita populer
$queryBeritaPopuler = mysqli_query($conn, "
    SELECT a.*, g.gambar
    FROM artikel a
    LEFT JOIN gambar_artikel g ON g.id_gambar_artikel = (
        SELECT id_gambar_artikel FROM gambar_artikel 
        WHERE gambar_artikel.id_artikel = a.id_artikel 
        ORDER BY id_gambar_artikel ASC LIMIT 1
    )
    ORDER BY a.views DESC
    LIMIT 6
");

// Ambil 6 berita terbaru (untuk widget)
$queryBeritaTerbaru = mysqli_query($conn, "
    SELECT a.*, g.gambar
    FROM artikel a
    LEFT JOIN gambar_artikel g ON g.id_gambar_artikel = (
        SELECT id_gambar_artikel FROM gambar_artikel 
        WHERE gambar_artikel.id_artikel = a.id_artikel 
        ORDER BY id_gambar_artikel ASC LIMIT 1
    )
    ORDER BY a.tanggal_artikel DESC
    LIMIT 6
");

// Ambil semua agenda
$query = mysqli_query($conn, "SELECT * FROM agenda ORDER BY tanggal_mulai ASC");

// Buat array agenda untuk frontend (kalender)
$agenda_events = [];
while ($row = mysqli_fetch_assoc($query)) {
    $event = [
        "title" => $row['judul_agenda'],
        "start" => $row['tanggal_mulai'],
        "end" => $row['tanggal_selesai'] ?: null,
        "time" => $row['jam_mulai'],
        "description" => $row['deskripsi_agenda'],
        "color" => $row['warna'],
        "pic" => $row['penanggung_jawab'],
        "location" => $row['lokasi_agenda'],
    ];
    $agenda_events[] = $event;
}

// Ambil data info berjalan (marquee)
$queryInfoBerjalan = mysqli_query($conn, "
    SELECT emoji, isi_info FROM info_berjalan
    ORDER BY id_info ASC
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

    <!-- FullCalendar CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">

    <style>
        #kalenderAgenda {
            font-size: 0.8rem;
        }

        .fc-toolbar-title {
            font-size: 1rem !important;
        }

        .fc-daygrid-event {
            font-size: 0.75rem !important;
        }

        .running-text-content {
            display: inline-block;
            animation: scrollText 20s linear infinite;
        }

        @keyframes scrollText {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .nav-tabs .nav-link.active {
            background-color: #008080;
            color: #fff;
            border-radius: 5px 5px 0 0;
        }

        .nav-tabs .nav-link {
            background-color: #f8f9fa;
            color: #333;
            border: 1px solid #dee2e6;
            margin-right: 5px;
            border-radius: 5px 5px 0 0;
        }

        .nav-tabs .nav-link:hover {
            background-color: #e9ecef;
            color: #008080;
        }

        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
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
    <?php $page = 'beranda'; ?>
    <?php include 'partials/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Desa <?php echo $desa['nama_desa'] ?></h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Desa <?php echo $desa['nama_desa'] ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Konten -->
    <div class="container-fluid mt-3">
        <div class="row mb-4">
            <!-- Kiri -->
            <div class="col-lg-2 sidebar-left text-center mb-3 order-3 order-lg-1">
                <img src="../assets/img/warga/<?= htmlspecialchars($dataKepalaDesa['foto']) ?>" alt="Kepala Desa" class="img-fluid rounded shadow" style="width: 250px; height: auto; object-fit: cover;">
                <h5 class="mt-3 mb-1 text-uppercase text-secondary">Kepala Desa :</h5>
                <strong class="text-dark"><?= htmlspecialchars($dataKepalaDesa['nama_warga']) ?></strong>
                <hr>
                <div class="bg-secondary p-3 rounded shadow-sm">
                    <div class="mb-2">
                        <i class="fas fa-chart-bar fa-2x text-light mb-2"></i>
                        <h6 class="mb-1 fw-bold text-light">Statistik Data</h6>
                    </div>
                    <p class="small text-light">Akses informasi statistik desa secara lengkap dan terupdate.</p>
                    <a href="statistik.php" class="btn btn-sm btn-outline-light text-warning px-3">Ke Statistik Data</a>
                </div>
                <hr>
                <div class="bg-white p-3 rounded shadow-sm border">
                    <h6 class="text-secondary fw-bold mb-3" style="border-left: 4px solid #2196f3; padding-left: 8px;">
                        <i class="fas fa-chart-bar me-1"></i> STATISTIK PENGUNJUNG
                    </h6>

                    <div class="mb-2 d-flex justify-content-between align-items-center text-white px-3 py-2 rounded" style="background-color: #1976d2;">
                        <span>Hari Ini</span>
                        <strong><?= number_format($hari_ini) ?></strong>
                    </div>

                    <div class="mb-2 d-flex justify-content-between align-items-center text-white px-3 py-2 rounded" style="background-color: #3f51b5;">
                        <span>Kemarin</span>
                        <strong><?= number_format($kemarin) ?></strong>
                    </div>

                    <div class="mb-2 d-flex justify-content-between align-items-center text-white px-3 py-2 rounded" style="background-color: #e53935;">
                        <span>Bulan Ini</span>
                        <strong><?= number_format($bulan) ?></strong>
                    </div>

                    <div class="mb-2 d-flex justify-content-between align-items-center text-white px-3 py-2 rounded" style="background-color: #d84315;">
                        <span>Tahun Ini</span>
                        <strong><?= number_format($tahun) ?></strong>
                    </div>

                    <div class="mb-1 d-flex justify-content-between align-items-center text-white px-3 py-2 rounded" style="background-color: #b71c1c;">
                        <span>Semua Waktu</span>
                        <strong><?= number_format($total) ?></strong>
                    </div>
                </div>
            </div>

            <!-- Tengah -->
            <div class="col-lg-7 main-slider d-flex flex-column mb-3 order-1 order-lg-2">
                <!-- Info Berjalan -->
                <div class="bg-light p-2 mb-3 rounded border">
                    <div class="running-text overflow-hidden position-relative" style="height: 30px;">
                        <div class="text-primary fw-semibold running-text-content d-inline-block" style="white-space: nowrap;">
                            <span id="scrollText">
                                <?php
                                $infoList = [];
                                while ($info = mysqli_fetch_assoc($queryInfoBerjalan)) {
                                    $emoji = htmlspecialchars($info['emoji']);
                                    $isi = htmlspecialchars($info['isi_info']);
                                    $infoList[] = $emoji . ' ' . $isi;
                                }
                                echo implode(' | ', $infoList) . ' |';
                                ?>
                            </span>
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                            <span id="scrollTextClone"></span>
                        </div>
                    </div>
                </div>

                <h5 class="text-primary">ARTIKEL TERBARU</h5>

                <?php while ($berita = mysqli_fetch_assoc($queryBerita)) : ?>
                    <div class="berita-item d-flex mb-3 align-items-start" style="background: #f8f9fa; padding: 10px; border-radius: 5px;">
                        <img src="../assets/img/artikel/<?= $berita['gambar'] ?>" alt="<?= $berita['alt'] ?>" class="rounded" style="width: 150px; height: 100px; object-fit: cover; margin-right: 15px;">
                        <div style="flex: 1;">
                            <h6 class="mt-0"><?= $berita['judul_berita'] ?></h6>
                            <p class="mb-1"><i class="far fa-user"></i> <?= $berita['author'] ?> &nbsp; | &nbsp; <i class="far fa-calendar-alt"></i> <?= $berita['tanggal_artikel'] ?> &nbsp; | &nbsp; <a href="detailberita.php?id=<?= $berita['id_artikel'] ?>" class="btn btn-sm btn-outline-primary">Selengkapnya</a></p>
                        </div>
                    </div>
                <?php endwhile; ?>

                <a href="berita.php" class="btn btn-sm btn-outline-warning">Lihat Semua Artikel</a>
            </div>

            <!-- Kanan -->
            <div class="col-lg-3 sidebar-right order-2 order-lg-3">
                <ul class="nav nav-tabs mb-3" id="beritaTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active fw-bold" id="populer-tab" data-bs-toggle="tab" data-bs-target="#populer" type="button" role="tab" aria-controls="populer" aria-selected="true">
                            <i class="fas fa-heart"></i> POPULER
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link fw-bold" id="terbaru-tab" data-bs-toggle="tab" data-bs-target="#terbaru" type="button" role="tab" aria-controls="terbaru" aria-selected="false">
                            <i class="far fa-clock"></i> TERBARU
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="populer">
                        <?php while ($populer = mysqli_fetch_assoc($queryBeritaPopuler)) : ?>
                            <a href="detailberita.php?id=<?= $populer['id_artikel'] ?>" class="text-decoration-none text-dark">
                                <div class="mb-3 d-flex">
                                    <img src="../assets/img/artikel/<?= htmlspecialchars($populer['gambar']) ?>" style="width: 70px; height: 70px; object-fit: cover; margin-right: 10px;">
                                    <div>
                                        <small class="text-muted">
                                            <i class="fas fa-eye"></i> DILIHAT <?= number_format($populer['views']) ?> KALI
                                        </small>
                                        <p class="mb-0"><?= htmlspecialchars($populer['judul_berita']) ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    </div>

                    <div class="tab-pane fade" id="terbaru">
                        <?php while ($terbaru = mysqli_fetch_assoc($queryBeritaTerbaru)) : ?>
                            <a href="detailberita.php?id=<?= $terbaru['id_artikel'] ?>" class="text-decoration-none text-dark">
                                <div class="mb-3 d-flex">
                                    <img src="../assets/img/artikel/<?= htmlspecialchars($terbaru['gambar']) ?>" style="width: 70px; height: 70px; object-fit: cover; margin-right: 10px;">
                                    <div>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar-alt"></i>
                                            <?= date('d M Y', strtotime($terbaru['tanggal_artikel'])) ?>
                                        </small>
                                        <p class="mb-0"><?= htmlspecialchars($terbaru['judul_berita']) ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    </div>

                </div>

                <!-- Kalender Agenda -->
                <div class="card border-0 shadow-sm mt-4">
                    <div class="card-header bg-primary text-white text-center fw-bold">
                        Kalender Agenda
                    </div>
                    <div class="card-body p-2">
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <select id="bulanSelect" class="form-select form-select-sm w-50 me-2">
                                <option value="0">Januari</option>
                                <option value="1">Februari</option>
                                <option value="2">Maret</option>
                                <option value="3">April</option>
                                <option value="4">Mei</option>
                                <option value="5">Juni</option>
                                <option value="6">Juli</option>
                                <option value="7">Agustus</option>
                                <option value="8">September</option>
                                <option value="9">Oktober</option>
                                <option value="10">November</option>
                                <option value="11">Desember</option>
                            </select>
                            <select id="tahunSelect" class="form-select form-select-sm w-50">
                                <!-- Diisi via JS -->
                            </select>
                        </div>
                        <div id="kalenderAgenda"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Garis pembatas -->
        <hr class="my-5 border-top border-2 border-dark">

        <div class="col-12 mt-5">
            <div class="text-center mb-5">
                <h2 class="fw-bold display-6">Layanan Mandiri</h2>
                <p class="text-muted fs-5">Nikmati Pelayanan Mandiri Secara Online</p>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-4">

                <!-- Profil Warga -->
                <a href="../warga/login.php" class="text-decoration-none">
                    <div class="d-flex align-items-center bg-white p-4 rounded shadow service-card" style="width: 360px;">
                        <div class="me-4 flex-shrink-0">
                            <div class="rounded p-4" style="background-color: #e0f7fa;">
                                <i class="fas fa-id-card fa-3x text-info"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1 fw-bold m-0">Profil Warga</h5>
                            <span class="text-muted">Lihat & Perbarui Data Kependudukan secara mandiri</span>
                        </div>
                    </div>
                </a>

                <!-- Pengajuan Surat -->
                <a href="../warga/login.php" class="text-decoration-none">
                    <div class="d-flex align-items-center bg-white p-4 rounded shadow service-card" style="width: 360px;">
                        <div class="me-4 flex-shrink-0">
                            <div class="rounded p-4" style="background-color: #f3e5f5;">
                                <i class="fas fa-envelope-open-text fa-3x text-primary"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1 fw-bold m-0">Pengajuan Surat</h5>
                            <span class="text-muted">Ajukan berbagai keperluan administrasi dengan mudah</span>
                        </div>
                    </div>
                </a>

                <!-- Status Layanan -->
                <a href="../warga/login.php" class="text-decoration-none">
                    <div class="d-flex align-items-center bg-white p-4 rounded shadow service-card" style="width: 360px;">
                        <div class="me-4 flex-shrink-0">
                            <div class="rounded p-4" style="background-color: #fff9c4;">
                                <i class="fas fa-tasks fa-3x text-warning"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1 fw-bold m-0">Status Layanan</h5>
                            <span class="text-muted">Pantau progres pengajuan surat dan permohonan Anda</span>
                        </div>
                    </div>
                </a>

                <!-- Pengaduan Online -->
                <a href="../warga/login.php" class="text-decoration-none">
                    <div class="d-flex align-items-center bg-white p-4 rounded shadow service-card" style="width: 360px;">
                        <div class="me-4 flex-shrink-0">
                            <div class="rounded p-4" style="background-color: #ffe0e0;">
                                <i class="fas fa-comment-dots fa-3x text-danger"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1 fw-bold m-0">Pengaduan Online</h5>
                            <span class="text-muted">Sampaikan masalah, keluhan, atau aspirasi ke pemerintah desa</span>
                        </div>
                    </div>
                </a>

            </div>
        </div>

    </div>

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

    <!-- Javascript -->
    <script src="../assets/js/main.js"></script>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        const scrollText = document.getElementById('scrollText');
        const clone = document.getElementById('scrollTextClone');
        clone.innerHTML = scrollText.innerHTML;

        document.addEventListener('DOMContentLoaded', function() {
            // Cek apakah sudah ditampilkan di tab ini
            if (!sessionStorage.getItem('welcomeShown')) {
                Swal.fire({
                    title: 'Selamat Datang!',
                    html: `
                            <p class="mb-1">Anda mengunjungi Website Resmi <strong>Desa Alas Kokon</strong>.</p>
                            <p class="mt-2">Jika Anda pendatang dan belum terdaftar sebagai warga, silakan daftar ke kantor desa atau secara online.</p>
                        `,
                    icon: 'info',
                    confirmButtonText: 'Saya Mengerti',
                    confirmButtonColor: '#3085d6',
                    backdrop: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });

                // Tandai bahwa alert sudah ditampilkan di tab ini
                sessionStorage.setItem('welcomeShown', 'true');
            }

            const calendarEl = document.getElementById('kalenderAgenda');

            // Ganti hardcode dengan data dari PHP
            const rawEvents = <?php echo json_encode($agenda_events); ?>;

            const adjustedEvents = rawEvents.map(event => {
                const endDate = event.end ? new Date(event.end) : null;

                if (endDate) {
                    endDate.setDate(endDate.getDate() + 1); // Karena FullCalendar eksklusif di end
                    return {
                        ...event,
                        end: endDate.toISOString().split('T')[0]
                    };
                } else {
                    return event; // Kalau tidak ada end, langsung pakai apa adanya
                }
            });

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                height: 400,
                events: adjustedEvents,
                eventClick: function(info) {
                    const start = new Date(info.event.start);
                    let end = info.event.end ? new Date(info.event.end) : null;

                    if (end) end.setDate(end.getDate() - 1);

                    const formatTanggal = (tgl) => {
                        return tgl.toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric'
                        });
                    };

                    const tanggalTeks = end ?
                        `${formatTanggal(start)} – ${formatTanggal(end)}` :
                        `${formatTanggal(start)}`;

                    Swal.fire({
                        title: info.event.title,
                        html: `
                                <div class="text-start">
                                    <strong>Lokasi:</strong><br>${info.event.extendedProps.location}<br><br>
                                    <strong>Deskripsi:</strong><br>${info.event.extendedProps.description}<br><br>
                                    <strong>Penanggung Jawab:</strong><br>${info.event.extendedProps.pic}<br><br>
                                    <strong><i class="far fa-calendar-alt me-1"></i> Tanggal:</strong><br>${tanggalTeks}
                                </div>
                            `,
                        icon: 'info',
                        confirmButtonText: 'Tutup'
                    });
                }
            });

            calendar.render();

            // Isi tahun dari 5 tahun lalu sampai 5 tahun depan
            const tahunSelect = document.getElementById('tahunSelect');
            const currentYear = new Date().getFullYear();
            for (let y = currentYear - 5; y <= currentYear + 5; y++) {
                const opt = document.createElement('option');
                opt.value = y;
                opt.textContent = y;
                if (y === currentYear) opt.selected = true;
                tahunSelect.appendChild(opt);
            }

            // Set bulan aktif ke bulan sekarang
            document.getElementById('bulanSelect').value = new Date().getMonth();

            // Event navigasi bulan/tahun
            document.getElementById('bulanSelect').addEventListener('change', function() {
                const month = parseInt(this.value);
                const year = parseInt(tahunSelect.value);
                calendar.gotoDate(new Date(year, month, 1));
            });

            document.getElementById('tahunSelect').addEventListener('change', function() {
                const month = parseInt(document.getElementById('bulanSelect').value);
                const year = parseInt(this.value);
                calendar.gotoDate(new Date(year, month, 1));
            });
        });
    </script>

</body>

</html>