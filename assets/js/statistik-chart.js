const chartInstances = {};

const colorPalette = [
    '#0d6efd', '#ffc107', '#dc3545', '#20c997',
    '#6f42c1', '#fd7e14', '#198754', '#6610f2', '#6c757d'
];

window.addEventListener('DOMContentLoaded', () => {

    // ==============================
    // DATA CONFIG: SEMUA PAKAI DUSUN
    // ==============================
    const chartConfigs = {
        'umur': {
            dusun: {
                'Dusun A': {
                    labels: ['0-5', '6-12', '13-17', '18-30', '31-45', '46-60', '60+'],
                    data: [
                        { jumlah: 20, laki: 10, perempuan: 10 },
                        { jumlah: 30, laki: 15, perempuan: 15 },
                        { jumlah: 25, laki: 13, perempuan: 12 },
                        { jumlah: 50, laki: 26, perempuan: 24 },
                        { jumlah: 40, laki: 21, perempuan: 19 },
                        { jumlah: 30, laki: 15, perempuan: 15 },
                        { jumlah: 15, laki: 8, perempuan: 7 }
                    ]
                },
                'Dusun B': {
                    labels: ['0-5', '6-12', '13-17', '18-30', '31-45', '46-60', '60+'],
                    data: [
                        { jumlah: 30, laki: 15, perempuan: 15 },
                        { jumlah: 50, laki: 25, perempuan: 25 },
                        { jumlah: 45, laki: 23, perempuan: 22 },
                        { jumlah: 70, laki: 35, perempuan: 35 },
                        { jumlah: 50, laki: 26, perempuan: 24 },
                        { jumlah: 30, laki: 15, perempuan: 15 },
                        { jumlah: 15, laki: 8, perempuan: 7 }
                    ]
                }
            },
            label: 'Umur'
        },
        'jenis-kelamin': {
            dusun: {
                'Dusun A': {
                    labels: ['Laki-laki', 'Perempuan'],
                    data: [
                        { jumlah: 120, laki: 120, perempuan: 0 },
                        { jumlah: 130, laki: 0, perempuan: 130 }
                    ]
                },
                'Dusun B': {
                    labels: ['Laki-laki', 'Perempuan'],
                    data: [
                        { jumlah: 110, laki: 110, perempuan: 0 },
                        { jumlah: 120, laki: 0, perempuan: 120 }
                    ]
                }
            },
            label: 'Jenis Kelamin'
        },
        'status-penduduk': {
            dusun: {
                'Dusun A': {
                    labels: ['Aktif', 'Pindah', 'Meninggal'],
                    data: [
                        { jumlah: 200, laki: 100, perempuan: 100 },
                        { jumlah: 10, laki: 5, perempuan: 5 },
                        { jumlah: 5, laki: 3, perempuan: 2 }
                    ]
                },
                'Dusun B': {
                    labels: ['Aktif', 'Pindah', 'Meninggal'],
                    data: [
                        { jumlah: 180, laki: 90, perempuan: 90 },
                        { jumlah: 15, laki: 8, perempuan: 7 },
                        { jumlah: 7, laki: 3, perempuan: 4 }
                    ]
                }
            },
            label: 'Status Penduduk'
        },
        'status-kawin': {
            dusun: {
                'Dusun A': {
                    labels: ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'],
                    data: [
                        { jumlah: 80, laki: 50, perempuan: 30 },
                        { jumlah: 120, laki: 60, perempuan: 60 },
                        { jumlah: 10, laki: 3, perempuan: 7 },
                        { jumlah: 5, laki: 2, perempuan: 3 }
                    ]
                },
                'Dusun B': {
                    labels: ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'],
                    data: [
                        { jumlah: 70, laki: 40, perempuan: 30 },
                        { jumlah: 130, laki: 70, perempuan: 60 },
                        { jumlah: 10, laki: 4, perempuan: 6 },
                        { jumlah: 5, laki: 3, perempuan: 2 }
                    ]
                }
            },
            label: 'Status Kawin'
        },
        'agama': {
            dusun: {
                'Dusun A': {
                    labels: ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Lainnya'],
                    data: [
                        { jumlah: 200, laki: 100, perempuan: 100 },
                        { jumlah: 20, laki: 10, perempuan: 10 },
                        { jumlah: 10, laki: 5, perempuan: 5 },
                        { jumlah: 5, laki: 3, perempuan: 2 },
                        { jumlah: 2, laki: 1, perempuan: 1 },
                        { jumlah: 3, laki: 2, perempuan: 1 }
                    ]
                },
                'Dusun B': {
                    labels: ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Lainnya'],
                    data: [
                        { jumlah: 180, laki: 90, perempuan: 90 },
                        { jumlah: 15, laki: 8, perempuan: 7 },
                        { jumlah: 12, laki: 6, perempuan: 6 },
                        { jumlah: 5, laki: 2, perempuan: 3 },
                        { jumlah: 3, laki: 1, perempuan: 2 },
                        { jumlah: 2, laki: 1, perempuan: 1 }
                    ]
                }
            },
            label: 'Agama'
        },
        'pendidikan': {
            dusun: {
                'Dusun A': {
                    labels: ['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'Diploma', 'S1', 'S2'],
                    data: [
                        { jumlah: 10, laki: 5, perempuan: 5 },
                        { jumlah: 50, laki: 25, perempuan: 25 },
                        { jumlah: 60, laki: 30, perempuan: 30 },
                        { jumlah: 50, laki: 25, perempuan: 25 },
                        { jumlah: 10, laki: 5, perempuan: 5 },
                        { jumlah: 30, laki: 15, perempuan: 15 },
                        { jumlah: 5, laki: 2, perempuan: 3 }
                    ]
                },
                'Dusun B': {
                    labels: ['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'Diploma', 'S1', 'S2'],
                    data: [
                        { jumlah: 8, laki: 4, perempuan: 4 },
                        { jumlah: 40, laki: 20, perempuan: 20 },
                        { jumlah: 55, laki: 28, perempuan: 27 },
                        { jumlah: 60, laki: 30, perempuan: 30 },
                        { jumlah: 7, laki: 3, perempuan: 4 },
                        { jumlah: 20, laki: 10, perempuan: 10 },
                        { jumlah: 3, laki: 1, perempuan: 2 }
                    ]
                }
            },
            label: 'Pendidikan'
        },
        'disabilitas': {
            dusun: {
                'Dusun A': {
                    labels: ['Tidak Disabilitas', 'Disabilitas'],
                    data: [
                        { jumlah: 240, laki: 120, perempuan: 120 },
                        { jumlah: 10, laki: 5, perempuan: 5 }
                    ]
                },
                'Dusun B': {
                    labels: ['Tidak Disabilitas', 'Disabilitas'],
                    data: [
                        { jumlah: 230, laki: 115, perempuan: 115 },
                        { jumlah: 8, laki: 4, perempuan: 4 }
                    ]
                }
            },
            label: 'Disabilitas'
        },
        'pekerjaan': {
            dusun: {
                'Dusun A': {
                    labels: ['Petani', 'Pedagang', 'Buruh', 'PNS', 'Guru', 'Lainnya'],
                    data: [
                        { jumlah: 50, laki: 30, perempuan: 20 },
                        { jumlah: 20, laki: 10, perempuan: 10 },
                        { jumlah: 30, laki: 20, perempuan: 10 },
                        { jumlah: 10, laki: 5, perempuan: 5 },
                        { jumlah: 5, laki: 2, perempuan: 3 },
                        { jumlah: 20, laki: 10, perempuan: 10 }
                    ]
                },
                'Dusun B': {
                    labels: ['Petani', 'Pedagang', 'Buruh', 'PNS', 'Guru', 'Lainnya'],
                    data: [
                        { jumlah: 40, laki: 20, perempuan: 20 },
                        { jumlah: 15, laki: 7, perempuan: 8 },
                        { jumlah: 35, laki: 18, perempuan: 17 },
                        { jumlah: 15, laki: 7, perempuan: 8 },
                        { jumlah: 7, laki: 3, perempuan: 4 },
                        { jumlah: 25, laki: 12, perempuan: 13 }
                    ]
                }
            },
            label: 'Pekerjaan'
        },
        'rumah': {
            dusun: {
                'Dusun A': {
                    labels: ['Milik Sendiri', 'Sewa', 'Menumpang'],
                    data: [
                        { jumlah: 150, laki: 75, perempuan: 75 },
                        { jumlah: 20, laki: 10, perempuan: 10 },
                        { jumlah: 10, laki: 5, perempuan: 5 }
                    ]
                },
                'Dusun B': {
                    labels: ['Milik Sendiri', 'Sewa', 'Menumpang'],
                    data: [
                        { jumlah: 140, laki: 70, perempuan: 70 },
                        { jumlah: 25, laki: 12, perempuan: 13 },
                        { jumlah: 8, laki: 4, perempuan: 4 }
                    ]
                }
            },
            label: 'Rumah'
        },
        'umkm': {
            dusun: {
                'Dusun A': {
                    labels: ['Usaha Mikro', 'Usaha Kecil', 'Usaha Menengah'],
                    data: [
                        { jumlah: 30 }, { jumlah: 10 }, { jumlah: 2 }
                    ]
                },
                'Dusun B': {
                    labels: ['Usaha Mikro', 'Usaha Kecil', 'Usaha Menengah'],
                    data: [
                        { jumlah: 20 }, { jumlah: 8 }, { jumlah: 3 }
                    ]
                }
            },
            label: 'UMKM'
        },
        'fasilitas-pendidikan': {
            labels: ['PAUD', 'TK', 'SD', 'SMP', 'SMA'],
            data: [
                { jumlah: 3 },
                { jumlah: 2 },
                { jumlah: 5 },
                { jumlah: 2 },
                { jumlah: 1 }
            ],
            label: 'Fasilitas Pendidikan'
        },
        'fasilitas-kesehatan': {
            dusun: {
                'Dusun A': {
                    labels: ['Posyandu', 'Puskesmas', 'Klinik'],
                    data: [
                        { jumlah: 3 },
                        { jumlah: 1 },
                        { jumlah: 1 }
                    ]
                },
                'Dusun B': {
                    labels: ['Posyandu', 'Puskesmas', 'Klinik'],
                    data: [
                        { jumlah: 2 },
                        { jumlah: 1 },
                        { jumlah: 0 }
                    ]
                }
            },
            label: 'Fasilitas Kesehatan'
        },
        'wilayah': {
            dusun: {
                'Dusun A': {
                    labels: ['RT 1', 'RT 2', 'RT 3', 'RT 4', 'RT 5'],
                    data: [
                        { jumlah: 50 },
                        { jumlah: 40 },
                        { jumlah: 30 },
                        { jumlah: 20 },
                        { jumlah: 10 }
                    ]
                },
                'Dusun B': {
                    labels: ['RT 1', 'RT 2', 'RT 3', 'RT 4', 'RT 5'],
                    data: [
                        { jumlah: 60 },
                        { jumlah: 50 },
                        { jumlah: 40 },
                        { jumlah: 30 },
                        { jumlah: 20 }
                    ]
                }
            },
            label: 'Wilayah Dusun'
        },
        'tempat-ibadah': {
            dusun: {
                'Dusun A': {
                    labels: ['Masjid', 'Mushola', 'Gereja', 'Pura'],
                    data: [
                        { jumlah: 2 },
                        { jumlah: 3 },
                        { jumlah: 1 },
                        { jumlah: 0 }
                    ]
                },
                'Dusun B': {
                    labels: ['Masjid', 'Mushola', 'Gereja', 'Pura'],
                    data: [
                        { jumlah: 1 },
                        { jumlah: 2 },
                        { jumlah: 0 },
                        { jumlah: 1 }
                    ]
                }
            },
            label: 'Tempat Ibadah'
        },
    };

    // ==============================
    // INISIALISASI CHART & TABEL
    // ==============================
    Object.entries(chartConfigs).forEach(([id, config]) => {
        const container = document.getElementById(id);
        if (!container) return;

        const chartContainer = container.querySelector('.chart-container');

        // ✅ Deteksi ada dusun atau tidak
        const hasDusun = !!config.dusun;
        const dusunKeys = hasDusun ? Object.keys(config.dusun) : [];
        const totalLabels = hasDusun ? config.dusun[dusunKeys[0]].labels : config.labels;

        const ctx = document.getElementById(`chart-${id}`);
        if (!ctx) return;

        // Destroy chart lama kalau ada
        if (chartInstances[id]) chartInstances[id].destroy();

        // ✅ Deteksi ada Laki / Perempuan atau tidak
        const hasLakiPerempuan = hasDusun
            ? !!config.dusun[dusunKeys[0]].data[0].laki
            : !!config.data[0].laki;

        // ======================
        // Build datasets chart
        // ======================
        const datasets = [
            {
                label: 'Jumlah',
                data: totalLabels.map((_, idx) => {
                    if (hasDusun) {
                        return dusunKeys.reduce((sum, k) => sum + config.dusun[k].data[idx].jumlah, 0);
                    } else {
                        return config.data[idx].jumlah;
                    }
                }),
                backgroundColor: '#0d6efd'
            }
        ];

        if (hasLakiPerempuan) {
            datasets.push(
                {
                    label: 'Laki-laki',
                    data: totalLabels.map((_, idx) => {
                        if (hasDusun) {
                            return dusunKeys.reduce((sum, k) => sum + config.dusun[k].data[idx].laki, 0);
                        } else {
                            return config.data[idx].laki;
                        }
                    }),
                    backgroundColor: '#20c997'
                },
                {
                    label: 'Perempuan',
                    data: totalLabels.map((_, idx) => {
                        if (hasDusun) {
                            return dusunKeys.reduce((sum, k) => sum + config.dusun[k].data[idx].perempuan, 0);
                        } else {
                            return config.data[idx].perempuan;
                        }
                    }),
                    backgroundColor: '#dc3545'
                }
            );
        }

        // ======================
        // Buat Chart
        // ======================
        chartInstances[id] = new Chart(ctx, {
            type: 'bar',
            data: { labels: totalLabels, datasets },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: true, position: 'top' } }
            }
        });

        // ======================
        // Buat Tabel
        // ======================
        if (hasDusun) {
            dusunKeys.forEach(namaDusun => {
                const dusunData = config.dusun[namaDusun];
                const tableDiv = document.createElement('div');
                tableDiv.className = 'table-responsive mt-4';

                const title = document.createElement('h6');
                title.textContent = `Dusun ${namaDusun}`;
                tableDiv.appendChild(title);

                const table = document.createElement('table');
                table.className = 'table table-bordered table-striped';

                const thead = document.createElement('thead');
                thead.className = 'table-light';
                thead.innerHTML = `
        <tr>
          <th>Kategori</th>
          <th>Jumlah</th>
          ${hasLakiPerempuan ? '<th>Laki-laki</th><th>Perempuan</th>' : ''}
        </tr>`;
                table.appendChild(thead);

                const tbody = document.createElement('tbody');
                dusunData.labels.forEach((label, idx) => {
                    const data = dusunData.data[idx];
                    const row = document.createElement('tr');
                    row.innerHTML = `
          <td>${label}</td>
          <td>${data.jumlah}</td>
          ${hasLakiPerempuan ? `<td>${data.laki || 0}</td><td>${data.perempuan || 0}</td>` : ''}
        `;
                    tbody.appendChild(row);
                });
                table.appendChild(tbody);
                tableDiv.appendChild(table);
                chartContainer.insertAdjacentElement('afterend', tableDiv);
            });
        } else {
            const tableDiv = document.createElement('div');
            tableDiv.className = 'table-responsive mt-4';

            const title = document.createElement('h6');
            title.textContent = `${config.label}`;
            tableDiv.appendChild(title);

            const table = document.createElement('table');
            table.className = 'table table-bordered table-striped';

            const thead = document.createElement('thead');
            thead.className = 'table-light';
            thead.innerHTML = `
      <tr>
        <th>Kategori</th>
        <th>Jumlah</th>
        ${hasLakiPerempuan ? '<th>Laki-laki</th><th>Perempuan</th>' : ''}
      </tr>`;
            table.appendChild(thead);

            const tbody = document.createElement('tbody');
            config.labels.forEach((label, idx) => {
                const data = config.data[idx];
                const row = document.createElement('tr');
                row.innerHTML = `
        <td>${label}</td>
        <td>${data.jumlah}</td>
        ${hasLakiPerempuan ? `<td>${data.laki || 0}</td><td>${data.perempuan || 0}</td>` : ''}
      `;
                tbody.appendChild(row);
            });
            table.appendChild(tbody);
            tableDiv.appendChild(table);
            chartContainer.insertAdjacentElement('afterend', tableDiv);
        }
    });


    // ==============================
    // HANDLE SELECTOR (BAR / PIE / MAP)
    // ==============================
    document.querySelectorAll('.statistik-section select').forEach(selector => {
        selector.addEventListener('change', function () {
            const chartId = this.dataset.chart;
            const type = this.value;
            const config = chartConfigs[chartId];
            const canvas = document.getElementById(`chart-${chartId}`);
            if (!canvas) return;

            let mapDiv = document.getElementById(`map-${chartId}`);
            const dusunKeys = Object.keys(config.dusun);
            const totalLabels = config.dusun[dusunKeys[0]].labels;
            const hasLakiPerempuan = !!config.dusun[dusunKeys[0]].data[0].laki;

            if (type === 'map') {
                canvas.style.display = 'none';
                if (!mapDiv) {
                    mapDiv = document.createElement('div');
                    mapDiv.id = `map-${chartId}`;
                    mapDiv.className = 'text-muted';
                    mapDiv.textContent = `[Peta ${chartId} belum tersedia]`;
                    canvas.insertAdjacentElement('afterend', mapDiv);
                } else {
                    mapDiv.style.display = 'block';
                }
            } else {
                if (mapDiv) mapDiv.style.display = 'none';
                canvas.style.display = 'block';

                if (chartInstances[chartId]) chartInstances[chartId].destroy();

                const datasets = (type === 'pie')
                    ? [{
                        label: 'Jumlah',
                        data: totalLabels.map((_, idx) =>
                            dusunKeys.reduce((sum, k) => sum + config.dusun[k].data[idx].jumlah, 0)
                        ),
                        backgroundColor: colorPalette.slice(0, totalLabels.length)
                    }]
                    : [
                        {
                            label: 'Jumlah',
                            data: totalLabels.map((_, idx) =>
                                dusunKeys.reduce((sum, k) => sum + config.dusun[k].data[idx].jumlah, 0)
                            ),
                            backgroundColor: '#0d6efd'
                        }
                    ];

                if (type === 'bar' && hasLakiPerempuan) {
                    datasets.push(
                        {
                            label: 'Laki-laki',
                            data: totalLabels.map((_, idx) =>
                                dusunKeys.reduce((sum, k) => sum + config.dusun[k].data[idx].laki, 0)
                            ),
                            backgroundColor: '#20c997'
                        },
                        {
                            label: 'Perempuan',
                            data: totalLabels.map((_, idx) =>
                                dusunKeys.reduce((sum, k) => sum + config.dusun[k].data[idx].perempuan, 0)
                            ),
                            backgroundColor: '#dc3545'
                        }
                    );
                }

                chartInstances[chartId] = new Chart(canvas, {
                    type: type,
                    data: { labels: totalLabels, datasets },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: true, position: 'top' } }
                    }
                });
            }
        });
    });


});