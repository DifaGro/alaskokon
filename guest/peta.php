    <?php
    include '../connect.php';

    $id_desa = 1;
    $query = mysqli_query($conn, "SELECT * FROM desa WHERE id_desa = $id_desa");
    $data = mysqli_fetch_assoc($query);
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

        <!-- Tambahkan di <head> -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <style>
            #mapDesa,
            #mapDusun {
                width: 100%;
                height: 500px;
                border-radius: 10px;
                border: 1px solid #ccc;
                margin-bottom: 30px;
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
        <?php $page = 'profil'; ?>
        <?php include 'partials/navbar.php'; ?>
        <!-- Navbar End -->


        <!-- Page Header Start -->
        <div class="container-fluid page-header py-5 mb-5">
            <div class="container py-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Peta Desa <?= htmlspecialchars($data['nama_desa']) ?></h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                        <li class="breadcrumb-item text-white" aria-current="page">Informasi</li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Peta Desa</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->

        <!-- Konten -->
        <div class="container-xxl py-5" id="peta">
            <div class="container">
                <!-- Peta 1: Batas Desa -->
                <div class="text-center mb-5">
                    <h6 class="text-primary text-uppercase">Peta Batas Desa <?= htmlspecialchars($data['nama_desa']) ?></h6>
                    <h1 class="mb-3">Batas Administratif Desa</h1>
                    <p class="text-muted">Berikut adalah peta batas wilayah administratif Desa <?= htmlspecialchars($data['nama_desa']) ?>.</p>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-12">
                        <div id="mapDesa"></div>
                    </div>
                </div>

                <!-- Peta 2: Batas Dusun -->
                <div class="text-center mb-5">
                    <h6 class="text-primary text-uppercase">Peta Batas Dusun</h6>
                    <h1 class="mb-3">Batas Wilayah Dusun</h1>
                    <p class="text-muted">Berikut adalah peta batas dusun di dalam Desa <?= htmlspecialchars($data['nama_desa']) ?>.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div id="mapDusun"></div>
                    </div>
                </div>

                <!-- Tombol Rute Google Maps -->
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <a href="https://www.google.com/maps/dir/?api=1&destination=<?= $data['latitude'] ?>,<?= $data['longitude'] ?>&travelmode=driving"
                            class="btn btn-primary"
                            target="_blank">
                            Lihat Rute ke Kantor Desa
                        </a>
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
        <script src="../assets/lib/wow/wow.min.js"></script>
        <script src="../assets/lib/easing/easing.min.js"></script>
        <script src="../assets/lib/waypoints/waypoints.min.js"></script>
        <script src="../assets/lib/counterup/counterup.min.js"></script>
        <script src="../assets/lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="../assets/lib/isotope/isotope.pkgd.min.js"></script>
        <script src="../assets/lib/lightbox/js/lightbox.min.js"></script>

        <!-- Template Javascript -->
        <script src="../assets/js/main.js"></script>

        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script>
            const lat = <?= $data['latitude'] ?>;
            const lng = <?= $data['longitude'] ?>;
            const namaDesa = "<?= addslashes($data['nama_desa']) ?>";

            // ============================
            // PETA 1: Batas Desa
            // ============================
            const mapDesa = L.map('mapDesa').setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap',
                maxZoom: 19
            }).addTo(mapDesa);

            L.marker([lat, lng]).addTo(mapDesa)
                .bindPopup("<strong>Kantor Desa " + namaDesa + "</strong>");

            fetch('../assets/geojson/Batas Desa Alas Kokon.geojson')
                .then(response => response.json())
                .then(data => {
                    const desaLayer = L.geoJSON(data, {
                        style: {
                            color: 'blue',
                            fillColor: '#3f8efc',
                            fillOpacity: 0.1
                        }
                    }).addTo(mapDesa).bindPopup("Batas Wilayah Desa " + namaDesa);

                    // Zoom ke batas
                    mapDesa.fitBounds(desaLayer.getBounds());
                });

            // ============================
            // PETA 2: Batas Dusun
            // ============================
            const mapDusun = L.map('mapDusun').setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap',
                maxZoom: 19
            }).addTo(mapDusun);

            L.marker([lat, lng]).addTo(mapDusun)
                .bindPopup("<strong>Kantor Desa " + namaDesa + "</strong>");

            const colors = {};
            const usedColors = [];

            fetch('../assets/geojson/Batas Dusun Alaskokon.geojson')
                .then(res => res.json())
                .then(data => {
                    data.features.forEach(f => {
                        const name = f.properties.nmsls;
                        if (!colors[name]) {
                            let color;
                            do {
                                color = '#' + Math.floor(Math.random() * 16777215).toString(16);
                            } while (usedColors.includes(color));
                            colors[name] = color;
                            usedColors.push(color);
                        }
                    });

                    const dusunLayer = L.geoJSON(data, {
                        style: feature => {
                            const name = feature.properties.nmsls;
                            return {
                                color: colors[name],
                                fillColor: colors[name],
                                fillOpacity: 0.4
                            };
                        },
                        onEachFeature: function(feature, layer) {
                            if (feature.properties && feature.properties.nmsls) {
                                layer.bindPopup("Dusun: " + feature.properties.nmsls);
                            }
                        }
                    }).addTo(mapDusun);

                    mapDusun.fitBounds(dusunLayer.getBounds());
                });
        </script>

    </body>

    </html>