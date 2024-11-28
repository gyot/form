$(document).ready(function () {
    const itemsPerPage = 4;
    let currentPage = 1;
    let totalData = 0;
    let displayedIds = []; // Menyimpan ID dari card yang sudah ditampilkan

    // Fungsi untuk mengambil data dari API Laravel berdasarkan halaman
    function fetchData(page) {
        console.log(window.location.origin+`/api/kegiatan?page=${page}&per_page=${itemsPerPage}`);
        
        $.ajax({
            url: window.location.origin+`/api/kegiatan?page=${page}&per_page=${itemsPerPage}`, // Ganti dengan URL API Laravel Anda
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                totalData = response.length; // Asumsi response.total adalah total data keseluruhan
                renderCards(response);
                renderPagination(page, response.last_page); // Asumsi response.last_page adalah total halaman
            },
            error: function (error) {
                console.error("Gagal mengambil data:", error);
            }
        });
    }

    // Fungsi untuk menampilkan kartu dengan animasi hanya untuk kartu baru
    function renderCards(data) {
        console.log(data);
        
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
                    <a href="#" class="btn btn-primary">Detail</a>
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
    $('#addCardForm').on('submit', function (e) {
        e.preventDefault();
        
        const formData = {
            title: $('#title').val(),
            content: $('#content').val(),
            image_url: $('#image_url').val()
        };

        $.ajax({
            url: 'http://localhost:8000/api/cards', // Ganti dengan URL API Laravel Anda untuk POST data
            method: 'POST',
            data: formData,
            success: function (response) {
                // Tutup modal setelah data ditambahkan
                $('#addCardModal').modal('hide');
                
                // Tambahkan data baru ke halaman pertama
                currentPage = 1;
                fetchData(currentPage);
            },
            error: function (error) {
                console.error("Gagal menambahkan data:", error);
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