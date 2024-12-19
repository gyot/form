
$(document).ready(function () {
    const itemsPerPage = 5;
    let currentPage = 1;
    let totalData = 0;
    let displayedIds = []; // Menyimpan ID dari card yang sudah ditampilkan

    // Fungsi untuk mengambil data dari API Laravel berdasarkan halaman
    function fetchData(page) {
        // console.log(BASE_URL+`/api/kegiatan?page=${page}&per_page=${itemsPerPage}`);
        
        $.ajax({
            url: BASE_URL+`/api/kegiatan?page=${page}&per_page=${itemsPerPage}`, // Ganti dengan URL API Laravel Anda
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                
                totalData = response.total; // Asumsi response.total adalah total data keseluruhan
                renderCards(response.data);
                renderPagination(page, response.last_page); // Asumsi response.last_page adalah total halaman
            },
            error: function (error) {
                console.error("Gagal mengambil data:", error);
            }
        });
    }

    // Fungsi untuk menampilkan kartu dengan animasi hanya untuk kartu baru
    function renderCards(data) {
        // console.log(data);
        
        $('#card-container').empty();

        data.forEach((item) => {
            const isNewCard = !displayedIds.includes(item.id); // Cek apakah card ini baru
            const imageUrl = item.image_url ? item.image_url : 'https://via.placeholder.com/300x200'; // URL gambar, gunakan placeholder jika tidak ada gambar

            const cardHtml = `

            <div class="card ${isNewCard ? 'new-card' : ''}">
                <img class="card-img-top"
                    src="${BASE_STORAGE_URL}/${item.flyer}"
                    alt="Card image" onerror="this.onerror=null; this.src='${BASE_URL}/img/logo_kemdikbud.png'">
                <div class="card-body">
                    <p><b>${item.nama_kegiatan}</b></p>
                    <p class="card-text">
                        <img src="${ BASE_URL }/img/icons/calendar.png" alt="Calendar Icon">
                        &nbsp; Tanggal ${formatTanggalSD(item.tanggal_mulai,item.tanggal_selesai)}
                    </p>
                    <p class="card-text">
                        <img src="${ BASE_URL }/img/icons/map.png" alt="Map Icon">
                        &nbsp; Balai Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat
                    </p>
                    <a href="home/kegiatan/" class="btn btn-primary btn-detail" data-route="home/kegiatan/detail/${item.id}">Detail</a>

                </div>
            </div>
            `;
            $('#card-container').append(cardHtml);

            // Jika card baru, tambahkan animasi fadeIn
            if (isNewCard) {
                $('#card-container .col-md-3').last().hide().fadeIn(600);
                displayedIds.push(item.id); // Simpan ID card yang sudah ditampilkan
            }
        });
    }

    // Fungsi untuk menampilkan elemen pagination
    function renderPagination(current, totalPages) {
        $('#pagination').empty();

        for (let i = 1; i <= totalPages; i++) {
            const pageItem = `
                <li class="page-item ${i === current ? 'active' : ''}">
                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                </li>
            `;
            $('#pagination').append(pageItem);
        }

        // Pagination Click Event
        $('.page-item').on('click', function (e) {
            e.preventDefault();
            const selectedPage = parseInt($(this).find('a').data('page'));
            if (selectedPage !== currentPage) {
                currentPage = selectedPage;
                fetchData(currentPage);
            }
        });
    }

    // Fungsi untuk menambahkan data baru
    $('#formTambahKegiatan').on('submit', function (e) {
        e.preventDefault();
        // let _token = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        // Event submit form
        Swal.fire({
            title: 'Submitting...',
            text: 'Please wait while we process your data.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading(); // Menampilkan animasi loading
            }
        });
        // Buat objek FormData untuk menangani input file
        let formData = new FormData(this);

        // Kirim data via AJAX
        $.ajax({
            url: $(this).attr('action'), // Ambil URL dari atribut 'action' pada form
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $('#formTambahKegiatan')[0].reset();
                // Tambahkan data baru ke halaman pertama
                currentPage = 1;
                fetchData(currentPage);
                // Tampilkan notifikasi sukses

                // Tutup modal
                $('#modalTambahKegiatan').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Your data has been submitted.',
                });
                // Refresh data pada tabel atau kartu
                // fetchData(1); // Panggil fungsi untuk mengambil data baru
            },
            error: function (error) {
                // Tampilkan pesan error
                console.error("Gagal menyimpan data:", error);

                // Tampilkan error detail jika ada
                if (error.responseJSON && error.responseJSON.errors) {
                    let errors = error.responseJSON.errors;
                    let errorMessages = Object.values(errors).flat().join("\n");
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: errorMessages,
                    });
                    // alert("Terjadi kesalahan:\n" + errorMessages);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Terjadi kesalahan saat menyimpan data!",
                    });
                    // alert('Terjadi kesalahan saat menyimpan data!');
                }
            }
        });
    });

    // Ambil data pertama kali saat halaman pertama dimuat
    fetchData(currentPage);
});

function formatTanggalSD(tanggalMulai, tanggalSelesai) {
    const bulan = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];

    // Konversi string tanggal ke objek Date
    const dateMulai = new Date(tanggalMulai);
    const dateSelesai = new Date(tanggalSelesai);

    // Ambil tanggal, bulan, dan tahun dari masing-masing Date
    const dMulai = dateMulai.getDate();
    const mMulai = dateMulai.getMonth();
    const yMulai = dateMulai.getFullYear();

    const dSelesai = dateSelesai.getDate();
    const mSelesai = dateSelesai.getMonth();
    const ySelesai = dateSelesai.getFullYear();

    // Format output berdasarkan kondisi
    if (tanggalMulai === tanggalSelesai) {
        return `${dMulai} ${bulan[mMulai]} ${yMulai}`;
    } else if (mMulai === mSelesai && yMulai === ySelesai) {
        return `${dMulai} s.d. ${dSelesai} ${bulan[mMulai]} ${yMulai}`;
    } else {
        return `${dMulai} ${bulan[mMulai]} ${yMulai} s.d. ${dSelesai} ${bulan[mSelesai]} ${ySelesai}`;
    }
}

// $(document).on('click', '.btn-detail', function (e) {
//     e.preventDefault();

//     const kegiatanId = $(this).data('id'); // Ambil ID kegiatan dari atribut data-id
//     const detailUrl = `${BASE_URL}/api/kegiatan/${kegiatanId}`; // Endpoint detail API

//     // Tampilkan loading di modal sebelum data dimuat
//     $('#detailContent').html('<p>Loading...</p>');
//     $('#modalTambahKegiatan').modal('show');

//     // Ambil data detail dari API
//     // $.ajax({
//     //     url: detailUrl,
//     //     method: 'GET',
//     //     dataType: 'json',
//     //     success: function (response) {
//     //         // Format data yang diterima untuk ditampilkan di modal
//     //         const detailHtml = `
//     //             <h5>${response.nama_kegiatan}</h5>
//     //             <img src="${BASE_STORAGE_URL}/${response.flyer}" alt="Flyer" class="img-fluid mb-3" onerror="this.onerror=null; this.src='${BASE_URL}/img/logo_kemdikbud.png'">
//     //             <p><b>Tanggal:</b> ${formatTanggalSD(response.tanggal_mulai, response.tanggal_selesai)}</p>
//     //             <p><b>Lokasi:</b> Balai Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat</p>
//     //             <p><b>Deskripsi:</b> ${response.deskripsi}</p>
//     //         `;

//     //         // Tampilkan data ke dalam modal
//     //         $('#detailContent').html(detailHtml);
//     //     },
//     //     error: function (error) {
//     //         console.error("Gagal memuat detail kegiatan:", error);
//     //         $('#detailContent').html('<p>Gagal memuat data. Silakan coba lagi.</p>');
//     //     }
//     // });
// });

$(document).ready(function () {
        
    $(document).on('click', '.btn-detail', function (e) {
        e.preventDefault(); // Mencegah tindakan default

        const route = $(this).data('route'); // Ambil rute dari data-route
        const baseUrl = BASE_URL.replace(/\/$/, ''); // Pastikan tidak ada trailing slash
        const newUrl = baseUrl + '/' + route; // Buat URL baru
        console.log(route);
        
        // Periksa apakah URL saat ini sudah sama
        if (window.location.href !== newUrl) {
            console.log(`Navigating to: ${newUrl}`);
            $('#content').html('<p>Loading...</p>'); // Tampilkan loading

            // Panggil data via AJAX
            $.ajax({
                url: newUrl,
                method: 'GET',
                success: function (response) {
                    $('#content').html(response); // Tampilkan konten baru

                    // Perbarui URL di browser
                    history.pushState({ route: route }, '', newUrl);
                },
                error: function (xhr, status, error) {
                    console.error('Gagal memuat halaman:', error);
                    $('#content').html('<p>Gagal memuat halaman. Silakan coba lagi.</p>');
                }
            });
        } else {
            console.log('URL tidak berubah.');
        }
    });

    // Tangani navigasi melalui tombol Back/Forward
    window.onpopstate = function (event) {
        if (event.state && event.state.route) {
            const route = event.state.route;
            const url = BASE_URL + '/' + route;

            console.log(`Navigating back to: ${url}`);

            // Muat ulang konten sesuai URL
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    $('#content').html(response);
                },
                error: function (xhr, status, error) {
                    console.error('Gagal memuat halaman:', error);
                    $('#content').html('<p>Gagal memuat halaman. Silakan coba lagi.</p>');
                }
            });
        }
    };
});

const route = window.location.href;; // Ambil rute dari data-route
        const baseUrl = BASE_URL.replace(/\/$/, ''); // Pastikan tidak ada trailing slash
        const newUrl = baseUrl + '/' + route; // Buat URL baru
        console.log(route);
        
        // Periksa apakah URL saat ini sudah sama
        if (window.location.href !== newUrl) {
            console.log(`Navigating to: ${newUrl}`);
            $('#content').html('<p>Loading...</p>'); // Tampilkan loading

            // Panggil data via AJAX
            $.ajax({
                url: newUrl,
                method: 'GET',
                success: function (response) {
                    $('#content').html(response); // Tampilkan konten baru

                    // Perbarui URL di browser
                    history.pushState({ route: route }, '', newUrl);
                },
                error: function (xhr, status, error) {
                    console.error('Gagal memuat halaman:', error);
                    $('#content').html('<p>Gagal memuat halaman. Silakan coba lagi.</p>');
                }
            });
        } else {
            console.log('URL tidak berubah.');
        }