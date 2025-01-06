
// $(document).ready(function () {  
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
                    <a href="kegiatan/detail/${item.id}" class="btn btn-primary btn-detail" data-route="home/kegiatan/detail/${item.id}">Detail</a>

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
            title: 'Menyimpan...',
            text: 'Mohon menunggu, data sedang diproses.',
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
                    title: 'Sukses!',
                    text: 'Data anda telah tersimpan.',
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

    // Ambil data pertama kali saat halaman pertama dimuat
    function fetchDataDetail(id){
        $.ajax({
            url: BASE_URL+`/api/kegiatan/detail/json/`+id, // Ganti dengan URL API Laravel Anda
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                console.log(BASE_URL+`/api/kegiatan/detail/json/`+id);
                
                // totalData = response.total; // Asumsi response.total adalah total data keseluruhan
                const cardHtml = `
                <img class="card-img-top"
                    src="${BASE_STORAGE_URL}/${response.flyer}"
                    alt="Card image" onerror="this.onerror=null; this.src='${BASE_URL}/img/logo_kemdikbud.png'">
                    <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td><strong>Nama Kegiatan</strong></td>
                            <td>: ${ response.nama_kegiatan }</td>
                        </tr>
                        <tr>
                            <td><strong>TPK</strong></td>
                            <td>: ${ response.tpk }</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Mulai</strong></td>
                            <td>: ${ formatTanggalSD(response.tanggal_mulai) }</td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Selesai</strong></td>
                            <td>: ${ formatTanggalSD(response.tanggal_selesai) }</td>
                        </tr>
                        <tr>
                            <td><strong>Pola Kegiatan</strong></td>
                            <td>: ${ response.pola_kegiatan }</td>
                        </tr>
                        
                        <tr>
                            <td><strong>Materi</strong></td>
                            <td>: <a href="${ response.materi }" class="btn btn-primary btn-sm" target="_blank">Lihat</a></td>
                        </tr>
                        <tr>
                            <td><strong>Dokumentasi</strong></td>
                            <td>: <a href="${ response.dokumentasi }" class="btn btn-secondary btn-sm" target="_blank">Lihat</a></td>
                        </tr>
                        <tr>
                            <td><strong>Panduan</strong></td>
                            <td>: <a href="${ response.panduan }" class="btn btn-info btn-sm" target="_blank">Lihat</a></td>
                        </tr>
                        <tr>
                            <td><strong>Jenis Kegiatan</strong></td>
                            <td>: ${ response.jenis_kegiatan }</td>
                        </tr>
                        <tr>
                            <td><strong>Kode Kegiatan</strong></td>
                            <td>: ${ response.kode_kegiatan }</td>
                        </tr>
                        <tr>
                            <td><strong>Pulsa</strong></td>
                            <td>: ${ response.pulsa }</td>
                        </tr>
                        <tr>
                            <td><strong>Rekening</strong></td>
                            <td>: ${ response.rekening }</td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>: <span class="badge ${ response.status == 'Aktif' ? 'bg-success' : 'bg-danger' }">${ response.status }</span></td>
                        </tr>
                        <tr>
                            <td><strong>Tautan Form </strong></td>
                            <td>: ${urlForm(response.id,response.nama_kegiatan)}</td>
                        </tr>
                    </tbody>
                </table>`;

                $('#detail-container').append(cardHtml);
            },
            error: function (error) {
                // console.log(BASE_URL+`/api/kegiatan/detail/json/`+id);
                console.error("Gagal mengambil data:", error);
            }
        });
    }

    function urlForm(id,judul) {
        let slug = judul
            .toLowerCase() // Ubah ke huruf kecil
            .replace(/[^a-z0-9\s-]/g, '') // Hapus karakter selain huruf, angka, spasi, atau tanda hubung
            .replace(/\s+/g, '-') // Ganti spasi dengan tanda hubung
            .replace(/-+/g, '-'); // Ganti tanda hubung ganda dengan satu tanda hubung
        return `Panitia : <a href='${BASE_URL}/form/${id}/panitia/${slug}' >${BASE_URL}/form/${id}/panitia/${slug}</a><br>
                Peserta : <a href='${BASE_URL}/form/${id}/peserta/${slug}' >${BASE_URL}/form/${id}/peserta/${slug}</a><br>
                Narasumber : <a href='${BASE_URL}/form/${id}/narasumber/${slug}' >${BASE_URL}/form/${id}/narasumber/${slug}</a><br>`;
    }
// });
