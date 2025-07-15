<?php
include '../connect.php';

// Query data agenda
$query = mysqli_query($conn, "SELECT * FROM agenda ORDER BY tanggal_mulai ASC");

// Buat array events
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
            min-height: 400px;
        }

        .fc-toolbar-title {
            font-size: 1rem !important;
        }

        .fc-daygrid-event {
            font-size: 0.75rem !important;
        }

        #agendaList {
            max-height: 490px;
            overflow-y: auto;
        }

        #agendaList::-webkit-scrollbar {
            width: 6px;
        }

        #agendaList::-webkit-scrollbar-thumb {
            background-color: #aaa;
            border-radius: 3px;
        }

        .swal-justify {
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
    <?php $page = 'kabar'; ?>
    <?php include 'partials/navbar.php'; ?>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Agenda Desa</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item text-white" aria-current="page">Kabar Desa</li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Agenda</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Konten Agenda Desa -->
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white fw-bold text-center">
                        Agenda Terdekat
                    </div>
                    <div class="card-body">
                        <ul class="list-group" id="agendaList" style="text-align: justify;"></ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white fw-bold d-flex justify-content-between align-items-center">
                        Kalender Agenda
                        <div class="d-flex">
                            <select id="bulanSelect" class="form-select form-select-sm me-2">
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
                            <select id="tahunSelect" class="form-select form-select-sm"></select>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div id="kalenderAgenda"></div>
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

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const agendaListEl = document.getElementById('agendaList');
            const calendarEl = document.getElementById('kalenderAgenda');
            const bulanSelect = document.getElementById('bulanSelect');
            const tahunSelect = document.getElementById('tahunSelect');

            if (!agendaListEl || !calendarEl || !bulanSelect || !tahunSelect) {
                console.warn('Elemen agenda atau kalender tidak ditemukan.');
                return;
            }

            // Ambil data dari PHP
            const rawEvents = <?php echo json_encode($agenda_events); ?>;

            // Urutkan berdasarkan tanggal mulai
            rawEvents.sort((a, b) => new Date(a.start) - new Date(b.start));

            // Tampilkan di daftar agenda terdekat
            rawEvents.forEach(event => {
                const li = document.createElement('li');
                li.classList.add('list-group-item');

                const start = new Date(event.start);
                const end = event.end ? new Date(event.end) : null;

                const formatTanggal = tgl => tgl.toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });

                const tanggal = end ? `${formatTanggal(start)} - ${formatTanggal(end)}` : formatTanggal(start);

                li.innerHTML = `
                            <strong>${event.title}</strong><br>
                            <small class="text-muted"><i class="far fa-calendar-alt me-1"></i>${tanggal}</small><br>
                            <small><strong>Jam:</strong> ${event.time || '-'}</small><br>
                            <small><strong>Penanggung Jawab:</strong> ${event.pic}</small><br>
                            <small><strong>Lokasi:</strong> ${event.location}</small><br>
                            <small><strong>Deskripsi:</strong> ${event.description}</small><br>
                            <button class="btn btn-sm btn-primary mt-2 btn-agenda-detail">Detail</button>
                        `;

                // Simpan data event ke dataset agar bisa diambil saat klik
                li.dataset.event = JSON.stringify(event);

                agendaListEl.appendChild(li);
            });

            // Tambahkan event listener untuk tombol detail di daftar agenda
            agendaListEl.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-agenda-detail')) {
                    const li = e.target.closest('li');
                    const event = JSON.parse(li.dataset.event);

                    const start = new Date(event.start);
                    let end = event.end ? new Date(event.end) : null;

                    const formatTanggal = tgl => tgl.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });

                    const tanggalTeks = end ? `${formatTanggal(start)} – ${formatTanggal(end)}` : `${formatTanggal(start)}`;

                    Swal.fire({
                        title: event.title,
                        html: `
                                <div class="swal-justify text-start">
                                    <strong>Lokasi:</strong><br>${event.location}<br><br>
                                    <strong><i class="far fa-clock me-1"></i> Jam:</strong><br>${event.time || '-'}<br><br>
                                    <strong><i class="far fa-calendar-alt me-1"></i> Tanggal:</strong><br>${tanggalTeks}<br><br>
                                    <strong>Deskripsi:</strong><br>${event.description.replace(/\n/g, '<br>')}<br><br>
                                    <strong>Penanggung Jawab:</strong><br>${event.pic}
                                </div>
                            `,
                        icon: 'info',
                        confirmButtonText: 'Tutup'
                    });
                }
            });

            // Sesuaikan end-date +1 hari (FullCalendar eksklusif end)
            const adjustedEvents = rawEvents.map(event => {
                if (event.end) {
                    const endDate = new Date(event.end);
                    endDate.setDate(endDate.getDate() + 1);
                    return {
                        ...event,
                        end: endDate.toISOString().split('T')[0]
                    };
                }
                return event;
            });

            // Render Kalender
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'id',
                height: 500,
                events: adjustedEvents,
                eventClick: function(info) {
                    const start = new Date(info.event.start);
                    let end = info.event.end ? new Date(info.event.end) : null;
                    if (end) end.setDate(end.getDate() - 1);

                    const formatTanggal = tgl => tgl.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });

                    const tanggalTeks = end ? `${formatTanggal(start)} – ${formatTanggal(end)}` : `${formatTanggal(start)}`;

                    Swal.fire({
                        title: info.event.title,
                        html: `
                                <div class="swal-justify text-start">
                                    <strong>Lokasi:</strong><br>${info.event.extendedProps.location}<br><br>
                                    <strong><i class="far fa-clock me-1"></i> Jam:</strong><br>${info.event.extendedProps.time || '-'}<br><br>
                                    <strong><i class="far fa-calendar-alt me-1"></i> Tanggal:</strong><br>${tanggalTeks}<br><br>
                                    <strong>Deskripsi:</strong><br>${info.event.extendedProps.description.replace(/\n/g, '<br>')}<br><br>
                                    <strong>Penanggung Jawab:</strong><br>${info.event.extendedProps.pic}
                                </div>
                            `,
                        icon: 'info',
                        confirmButtonText: 'Tutup'
                    });
                }
            });

            setTimeout(() => calendar.render(), 50);

            // Isi dropdown tahun
            const currentYear = new Date().getFullYear();
            for (let y = currentYear - 5; y <= currentYear + 5; y++) {
                const opt = document.createElement('option');
                opt.value = y;
                opt.textContent = y;
                if (y === currentYear) opt.selected = true;
                tahunSelect.appendChild(opt);
            }

            // Set bulan sekarang
            bulanSelect.value = new Date().getMonth();

            // Navigasi bulan/tahun
            function updateCalendarView() {
                const month = parseInt(bulanSelect.value);
                const year = parseInt(tahunSelect.value);
                calendar.gotoDate(new Date(year, month, 1));
            }

            bulanSelect.addEventListener('change', updateCalendarView);
            tahunSelect.addEventListener('change', updateCalendarView);
        });
    </script>


</body>

</html>