<?php
include '../connect.php';

// Ambil data desa
$queryDesa = mysqli_query($conn, "SELECT * FROM desa WHERE id_desa = 1");
$dataDesa = mysqli_fetch_assoc($queryDesa);

// Ambil max 6 gambar dari artikel yang id_desa = 1
$queryGambar = mysqli_query($conn, "
    SELECT ga.*
    FROM artikel a
    LEFT JOIN gambar_artikel ga ON a.id_artikel = ga.id_artikel
    WHERE a.id_desa = 1 AND ga.id_gambar_artikel IS NOT NULL AND a.jenis != 'pengumuman'
    LIMIT 6
");
?>

<div class="container-fluid bg-dark text-body footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <!-- Alamat -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Alamat</h5>
                <p class="mb-2">
                    <i class="fa fa-map-marker-alt me-3"></i>
                    <?php
                    $kecamatan = htmlspecialchars($dataDesa['kecamatan'] ?? '');
                    $kabupaten = htmlspecialchars($dataDesa['kabupaten'] ?? '');
                    $provinsi = htmlspecialchars($dataDesa['provinsi'] ?? '');
                    if ($kecamatan || $kabupaten || $provinsi) {
                        echo "Kec. $kecamatan, Kab. $kabupaten, $provinsi";
                    } else {
                        echo "Alamat belum tersedia.";
                    }
                    ?>
                </p>
                <p class="mb-2">
                    <i class="fa fa-phone-alt me-3"></i>
                    <?= !empty($dataDesa['no_hp']) ? htmlspecialchars($dataDesa['no_hp']) : 'Nomor HP belum tersedia.'; ?>
                </p>
                <p class="mb-2">
                    <i class="fa fa-envelope me-3"></i>
                    <?= !empty($dataDesa['email']) ? htmlspecialchars($dataDesa['email']) : 'Email belum tersedia.'; ?>
                </p>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Quick Links</h5>
                <a class="btn btn-link" href="strukturdesa.php">Struktur Perangkat Desa</a>
                <a class="btn btn-link" href="petadesa.php">Peta Desa</a>
                <a class="btn btn-link" href="berita.php">Berita Desa</a>
                <a class="btn btn-link" href="statistik.php">Statistik Desa</a>
                <a class="btn btn-link" href="tanyaai.php">Tanya AI</a>
            </div>

            <div class="col-lg-3 col-md-6"></div>

            <!-- Gallery -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-white mb-4">Gallery</h5>
                <div class="row g-2">
                    <?php
                    $adaGambar = false;

                    if (mysqli_num_rows($queryGambar) > 0):
                        while ($gambar = mysqli_fetch_assoc($queryGambar)):
                            if (!empty($gambar['gambar'])): // Cek kolom gambar TIDAK NULL / TIDAK kosong
                                $adaGambar = true; // Set flag true
                    ?>
                                <div class="col-4">
                                    <img class="img-fluid rounded" src="../assets/img/artikel/<?= htmlspecialchars($gambar['gambar']); ?>" alt="<?= htmlspecialchars($gambar['alt']); ?>">
                                </div>
                        <?php
                            endif;
                        endwhile;
                    endif;

                    if (!$adaGambar):
                        ?>
                        <div class="col-12 text-white">
                            Belum ada foto.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; Copyright. 2025. Badan Pusat Statistik Kabupaten Bangkalan.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    Dikembangkan Oleh BPS Kabupaten Bangkalan
                </div>
            </div>
        </div>
    </div>
</div>

<a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top">
    <i class="bi bi-arrow-up"></i>
</a>