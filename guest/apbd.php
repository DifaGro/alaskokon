<?php
include '../connect.php'; // file koneksi database

// Ambil Pendapatan
$pendapatan = mysqli_query($conn, "SELECT SUM(anggaran) AS total_anggaran, SUM(realisasi) AS total_realisasi FROM apbdes WHERE jenis='pendapatan'");
$row_pendapatan = mysqli_fetch_assoc($pendapatan);

// Ambil Belanja
$belanja = mysqli_query($conn, "SELECT SUM(anggaran) AS total_anggaran, SUM(realisasi) AS total_realisasi FROM apbdes WHERE jenis='belanja'");
$row_belanja = mysqli_fetch_assoc($belanja);

// Ambil Pembiayaan
$pembiayaan = mysqli_query($conn, "SELECT SUM(anggaran) AS total_anggaran, SUM(realisasi) AS total_realisasi FROM apbdes WHERE jenis='pembiayaan'");
$row_pembiayaan = mysqli_fetch_assoc($pembiayaan);

// Ambil Detail Pendapatan
$pendapatan_detail = mysqli_query($conn, "SELECT keterangan, realisasi, warna FROM apbdes WHERE jenis='pendapatan'");
$pendapatan_labels = [];
$pendapatan_realisasi = [];
$pendapatan_warna = [];
while ($row = mysqli_fetch_assoc($pendapatan_detail)) {
    $pendapatan_labels[] = $row['keterangan'];
    $pendapatan_realisasi[] = $row['realisasi'];
    $pendapatan_warna[] = $row['warna'];
}

// Ambil Detail Belanja
$belanja_detail = mysqli_query($conn, "SELECT keterangan, realisasi, warna FROM apbdes WHERE jenis='belanja'");
$belanja_labels = [];
$belanja_realisasi = [];
$belanja_warna = [];
while ($row = mysqli_fetch_assoc($belanja_detail)) {
    $belanja_labels[] = $row['keterangan'];
    $belanja_realisasi[] = $row['realisasi'];
    $belanja_warna[] = $row['warna'];
}

// Ambil Detail Pembiayaan
$pembiayaan_detail = mysqli_query($conn, "SELECT keterangan, realisasi, warna FROM apbdes WHERE jenis='pembiayaan'");
$pembiayaan_labels = [];
$pembiayaan_realisasi = [];
$pembiayaan_warna = [];
while ($row = mysqli_fetch_assoc($pembiayaan_detail)) {
    $pembiayaan_labels[] = $row['keterangan'];
    $pembiayaan_realisasi[] = $row['realisasi'];
    $pembiayaan_warna[] = $row['warna'];
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
        .chart-container {
            width: 280px;
            height: 280px;
            margin: 0 auto;
            position: relative;
        }

        .chart-canvas {
            width: 100% !important;
            height: 100% !important;
        }

        .pie-wrapper {
            min-height: 420px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 768px) {
            .pie-wrapper {
                min-height: unset;
            }
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
    <?php $page = 'informasi'; ?>
    <?php include 'partials/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Anggaran Pendapatan dan Belanja Desa</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Informasi</li>
                    <li class="breadcrumb-item text-white active" aria-current="page">APBDes</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Konten APBDes Grafik -->
    <div class="container-fluid mt-3">
        <div class="p-4 bg-white border rounded shadow-sm">
            <h4 class="text-primary mb-4">Grafik APBDes 2025</h4>

            <!-- Grafik Batang: Anggaran vs Realisasi -->
            <div class="text-center mb-4">
                <h4 class="text-primary mb-3">Perbandingan Anggaran vs Realisasi</h4>
                <div style="max-width: 1000px; margin: auto;">
                    <canvas id="apbdesBarChart"></canvas>
                </div>
            </div>

            <!-- Garis pembatas -->
            <hr class="my-5 border-top border-2 border-dark">

            <!-- Detail Realisasi -->
            <div class="row mt-5 align-items-start">

                <!-- Pendapatan Desa -->
                <div class="col-md-4 mb-5">
                    <div class="pie-wrapper">
                        <h5 class="fw-bold text-center mb-4">Distribusi Realisasi Pendapatan</h5>
                        <div class="chart-container">
                            <canvas id="chartPendapatanDetail" class="chart-canvas"></canvas>
                        </div>
                        <div id="legendPendapatan" class="mt-3 text-center small"></div>
                    </div>

                    <h5 class="text-center mb-4">Pendapatan Desa</h5>

                    <?php
                    $pendapatan = mysqli_query($conn, "SELECT keterangan, anggaran, realisasi FROM apbdes WHERE jenis='pendapatan'");
                    $total_anggaran_pendapatan = 0;
                    $total_realisasi_pendapatan = 0;

                    while ($row = mysqli_fetch_assoc($pendapatan)) {
                        $persen = $row['anggaran'] > 0 ? ($row['realisasi'] / $row['anggaran']) * 100 : 0;
                        $total_anggaran_pendapatan += $row['anggaran'];
                        $total_realisasi_pendapatan += $row['realisasi'];
                    ?>
                        <div class="mb-2"><?= htmlspecialchars($row['keterangan']) ?></div>
                        <div class="fw-bold">
                            Anggaran: Rp <?= number_format($row['anggaran'], 2, ',', '.') ?> <br>
                            Realisasi: Rp <?= number_format($row['realisasi'], 2, ',', '.') ?>
                        </div>
                        <div class="progress mt-1 mb-3" style="height: 20px;">
                            <div class="progress-bar bg-primary text-end pe-2" role="progressbar"
                                style="width: <?= round($persen) ?>%;" aria-valuenow="<?= round($persen) ?>" aria-valuemin="0" aria-valuemax="100"><?= round($persen) ?>%</div>
                        </div>
                    <?php } ?>

                    <hr>
                    <div class="fw-bold text-end">
                        Total Anggaran: Rp <?= number_format($total_anggaran_pendapatan, 2, ',', '.') ?> <br>
                        Total Realisasi: Rp <?= number_format($total_realisasi_pendapatan, 2, ',', '.') ?>
                    </div>
                    <?php
                    $persen_total_pendapatan = $total_anggaran_pendapatan > 0 ? ($total_realisasi_pendapatan / $total_anggaran_pendapatan) * 100 : 0;
                    ?>
                    <div class="progress mt-1 mb-3" style="height: 22px;">
                        <div class="progress-bar bg-success fw-bold text-end pe-2" role="progressbar"
                            style="width: <?= round($persen_total_pendapatan) ?>%;" aria-valuenow="<?= round($persen_total_pendapatan) ?>" aria-valuemin="0" aria-valuemax="100"><?= round($persen_total_pendapatan) ?>%</div>
                    </div>
                </div>

                <!-- Belanja Desa -->
                <div class="col-md-4 mb-5">
                    <div class="pie-wrapper">
                        <h5 class="fw-bold text-center mb-4">Distribusi Realisasi Belanja</h5>
                        <div class="chart-container">
                            <canvas id="chartBelanjaDetail" class="chart-canvas"></canvas>
                        </div>
                        <div id="legendBelanja" class="mt-3 text-center small"></div>
                    </div>

                    <h5 class="text-center mb-4">Belanja Desa</h5>

                    <?php
                    $belanja = mysqli_query($conn, "SELECT keterangan, anggaran, realisasi FROM apbdes WHERE jenis='belanja'");
                    $total_anggaran_belanja = 0;
                    $total_realisasi_belanja = 0;

                    while ($row = mysqli_fetch_assoc($belanja)) {
                        $persen = $row['anggaran'] > 0 ? ($row['realisasi'] / $row['anggaran']) * 100 : 0;
                        $total_anggaran_belanja += $row['anggaran'];
                        $total_realisasi_belanja += $row['realisasi'];
                    ?>
                        <div class="mb-2"><?= htmlspecialchars($row['keterangan']) ?></div>
                        <div class="fw-bold">
                            Anggaran: Rp <?= number_format($row['anggaran'], 2, ',', '.') ?> <br>
                            Realisasi: Rp <?= number_format($row['realisasi'], 2, ',', '.') ?>
                        </div>
                        <div class="progress mt-1 mb-3" style="height: 20px;">
                            <div class="progress-bar bg-primary text-end pe-2" role="progressbar"
                                style="width: <?= round($persen) ?>%;" aria-valuenow="<?= round($persen) ?>" aria-valuemin="0" aria-valuemax="100"><?= round($persen) ?>%</div>
                        </div>
                    <?php } ?>

                    <hr>
                    <div class="fw-bold text-end">
                        Total Anggaran: Rp <?= number_format($total_anggaran_belanja, 2, ',', '.') ?> <br>
                        Total Realisasi: Rp <?= number_format($total_realisasi_belanja, 2, ',', '.') ?>
                    </div>
                    <?php
                    $persen_total_belanja = $total_anggaran_belanja > 0 ? ($total_realisasi_belanja / $total_anggaran_belanja) * 100 : 0;
                    ?>
                    <div class="progress mt-1 mb-3" style="height: 22px;">
                        <div class="progress-bar bg-success fw-bold text-end pe-2" role="progressbar"
                            style="width: <?= round($persen_total_belanja) ?>%;" aria-valuenow="<?= round($persen_total_belanja) ?>" aria-valuemin="0" aria-valuemax="100"><?= round($persen_total_belanja) ?>%</div>
                    </div>
                </div>

                <!-- Pembiayaan Desa -->
                <div class="col-md-4 mb-5">
                    <div class="pie-wrapper">
                        <h5 class="fw-bold text-center mb-4">Distribusi Realisasi Pembiayaan</h5>
                        <div class="chart-container">
                            <canvas id="chartPembiayaanDetail" class="chart-canvas"></canvas>
                        </div>
                        <div id="legendPembiayaan" class="mt-3 text-center small"></div>
                    </div>

                    <h5 class="text-center mb-4">Pembiayaan Desa</h5>

                    <?php
                    $pembiayaan = mysqli_query($conn, "SELECT keterangan, anggaran, realisasi FROM apbdes WHERE jenis='pembiayaan'");
                    $total_anggaran_pembiayaan = 0;
                    $total_realisasi_pembiayaan = 0;

                    while ($row = mysqli_fetch_assoc($pembiayaan)) {
                        $persen = $row['anggaran'] > 0 ? ($row['realisasi'] / $row['anggaran']) * 100 : 0;
                        $total_anggaran_pembiayaan += $row['anggaran'];
                        $total_realisasi_pembiayaan += $row['realisasi'];
                    ?>
                        <div class="mb-2"><?= htmlspecialchars($row['keterangan']) ?></div>
                        <div class="fw-bold">
                            Anggaran: Rp <?= number_format($row['anggaran'], 2, ',', '.') ?> <br>
                            Realisasi: Rp <?= number_format($row['realisasi'], 2, ',', '.') ?>
                        </div>
                        <div class="progress mt-1 mb-3" style="height: 20px;">
                            <div class="progress-bar bg-primary text-end pe-2" role="progressbar"
                                style="width: <?= round($persen) ?>%;" aria-valuenow="<?= round($persen) ?>" aria-valuemin="0" aria-valuemax="100"><?= round($persen) ?>%</div>
                        </div>
                    <?php } ?>

                    <hr>
                    <div class="fw-bold text-end">
                        Total Anggaran: Rp <?= number_format($total_anggaran_pembiayaan, 2, ',', '.') ?> <br>
                        Total Realisasi: Rp <?= number_format($total_realisasi_pembiayaan, 2, ',', '.') ?>
                    </div>
                    <?php
                    $persen_total_pembiayaan = $total_anggaran_pembiayaan > 0 ? ($total_realisasi_pembiayaan / $total_anggaran_pembiayaan) * 100 : 0;
                    ?>
                    <div class="progress mt-1 mb-3" style="height: 22px;">
                        <div class="progress-bar bg-success fw-bold text-end pe-2" role="progressbar"
                            style="width: <?= round($persen_total_pembiayaan) ?>%;" aria-valuenow="<?= round($persen_total_pembiayaan) ?>" aria-valuemin="0" aria-valuemax="100"><?= round($persen_total_pembiayaan) ?>%</div>
                    </div>
                </div>

            </div>

        </div>
    </div>



    <!-- Footer Start -->
    <?php include 'partials/footer.php'; ?>
    <!-- Footer End -->


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script src="../assets/lib/wow/wow.min.js"></script>
    <script src="../assets/lib/easing/easing.min.js"></script>
    <script src="../assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../assets/lib/counterup/counterup.min.js"></script>
    <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../assets/lib/isotope/isotope.pkgd.min.js"></script>
    <script src="../assets/lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="../assets/js/main.js"></script>

    <!-- Script Grafik APBDes -->
    <script>
        // Data Anggaran
        const anggaranData = {
            pendapatan: <?php echo $row_pendapatan['total_anggaran']; ?>,
            belanja: <?php echo $row_belanja['total_anggaran']; ?>,
            pembiayaan: <?php echo $row_pembiayaan['total_anggaran']; ?>
        };

        const realisasiData = {
            pendapatan: <?php echo $row_pendapatan['total_realisasi']; ?>,
            belanja: <?php echo $row_belanja['total_realisasi']; ?>,
            pembiayaan: <?php echo $row_pembiayaan['total_realisasi']; ?>
        };

        // Detail Data
        const pendapatanLabels = <?php echo json_encode($pendapatan_labels); ?>;
        const pendapatanRealisasi = <?php echo json_encode($pendapatan_realisasi); ?>;
        const pendapatanColors = <?php echo json_encode($pendapatan_warna); ?>;

        const belanjaLabels = <?php echo json_encode($belanja_labels); ?>;
        const belanjaRealisasi = <?php echo json_encode($belanja_realisasi); ?>;
        const belanjaColors = <?php echo json_encode($belanja_warna); ?>;

        const pembiayaanLabels = <?php echo json_encode($pembiayaan_labels); ?>;
        const pembiayaanRealisasi = <?php echo json_encode($pembiayaan_realisasi); ?>;
        const pembiayaanColors = <?php echo json_encode($pembiayaan_warna); ?>;

        // Fungsi buat pie chart
        function createPieChart(ctx, labels, data, colors) {
            return new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: colors,
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: ctx => `${ctx.label}: Rp ${ctx.raw.toLocaleString('id-ID')}`
                            }
                        },
                        datalabels: {
                            color: '#fff',
                            font: {
                                weight: 'bold'
                            },
                            formatter: (value, context) => {
                                const dataset = context.chart.data.datasets[0];
                                const data = dataset.data.map(v => Number(v));
                                const total = data.reduce((sum, val) => sum + val, 0);
                                const percentage = total > 0 ? (value / total) * 100 : 0;
                                return percentage.toFixed(1) + '%';
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
        }


        // Fungsi untuk membuat legenda custom dan interaktif
        function generateLegend(chart, labels, colors, containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = labels.map((label, i) => `
            <span class="legend-item" data-index="${i}" style="display:inline-block;margin:0 8px 6px 0;cursor:pointer;">
                <span style="display:inline-block;width:12px;height:12px;background-color:${colors[i]};margin-right:6px;border-radius:2px;"></span>
                ${label}
            </span>
        `).join('');

            const items = container.querySelectorAll('.legend-item');
            items.forEach(item => {
                item.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    const meta = chart.getDatasetMeta(0);
                    const segment = meta.data[index];

                    // Toggle visibility
                    segment.hidden = !segment.hidden;

                    // Optional: Tambah efek visual di legenda
                    this.style.opacity = segment.hidden ? "0.5" : "1";

                    chart.update();
                });
            });
        }

        // === PIE CHARTS ===
        const chartPendapatan = createPieChart(
            document.getElementById('chartPendapatanDetail').getContext('2d'),
            pendapatanLabels,
            pendapatanRealisasi,
            pendapatanColors
        );
        generateLegend(chartPendapatan, pendapatanLabels, pendapatanColors, 'legendPendapatan');

        const chartBelanja = createPieChart(
            document.getElementById('chartBelanjaDetail').getContext('2d'),
            belanjaLabels,
            belanjaRealisasi,
            belanjaColors
        );
        generateLegend(chartBelanja, belanjaLabels, belanjaColors, 'legendBelanja');

        const chartPembiayaan = createPieChart(
            document.getElementById('chartPembiayaanDetail').getContext('2d'),
            pembiayaanLabels,
            pembiayaanRealisasi,
            pembiayaanColors
        );
        generateLegend(chartPembiayaan, pembiayaanLabels, pembiayaanColors, 'legendPembiayaan');

        // === BAR CHART ===
        const ctxBar = document.getElementById('apbdesBarChart').getContext('2d');
        const apbdesBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Pendapatan', 'Belanja', 'Pembiayaan'],
                datasets: [{
                        label: 'Anggaran',
                        data: [
                            anggaranData.pendapatan,
                            anggaranData.belanja,
                            anggaranData.pembiayaan
                        ],
                        backgroundColor: 'rgba(54, 162, 235, 0.8)'
                    },
                    {
                        label: 'Realisasi',
                        data: [
                            realisasiData.pendapatan,
                            realisasiData.belanja,
                            realisasiData.pembiayaan
                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.8)'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => 'Rp ' + value.toLocaleString('id-ID')
                        }
                    },
                    x: {
                        ticks: {
                            display: window.innerWidth >= 415
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: context => {
                                let label = context.dataset.label || '';
                                if (label) label += ': ';
                                label += 'Rp ' + context.raw.toLocaleString('id-ID');
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Update bar chart saat resize (responsive)
        window.addEventListener('resize', () => {
            const showLabels = window.innerWidth >= 415;
            apbdesBarChart.options.scales.x.ticks.display = showLabels;
            apbdesBarChart.update();
        });
    </script>

</body>

</html>