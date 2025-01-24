
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
                    <a href="kegiatan/detail/${item.id}" class="btn btn-primary btn-detail" data-route="home/kegiatan/detail/${item.id}">Detail</a>
                    <a href="#" class="btn btn-primary btn-danger" onclick="alert('mati')">Non Aktifkan</a>
                    <p><b>${item.nama_kegiatan}</b></p>
                    <p class="card-text">
                        <img src="${ BASE_URL }/img/icons/calendar.png" alt="Calendar Icon">
                        &nbsp; Tanggal ${formatTanggalSD(item.tanggal_mulai,item.tanggal_selesai)}
                    </p>
                    <p class="card-text">
                        <img src="${ BASE_URL }/img/icons/map.png" alt="Map Icon">
                        &nbsp; Balai Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat
                    </p>
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
                console.log(response);
                
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: response,
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
                let h_peserta='';
                let h_panitia='';
                let h_narasumber='';
                console.log(BASE_URL+`/api/kegiatan/detail/json/`+id);
                if(response.h_peserta==0){
                    h_peserta='tidak ada';
                }
                else if(response.h_peserta==1){
                    h_peserta='Pulsa';
                }else if(response.h_peserta==2){
                    h_peserta='Rekening';
                }else if (response.h_peserta==3) {
                    h_peserta='Pulsa & Rekening';
                }

                if(response.h_panitia==0){
                    h_panitia='tidak ada';
                }
                else if(response.h_panitia==1){
                    h_panitia='Pulsa';
                }else if(response.h_panitia==2){
                    h_panitia='Rekening';
                }else if (response.h_panitia==3) {
                    h_panitia='Pulsa & Rekening';
                }

                if(response.h_narasumber==0){
                    h_narasumber='tidak ada';
                }
                else if(response.h_narasumber==1){
                    h_narasumber='Pulsa';
                }else if(response.h_narasumber==2){
                    h_narasumber='Rekening';
                }else if (response.h_narasumber==3) {
                    h_narasumber='Pulsa & Rekening';
                }
                // totalData = response.total; // Asumsi response.total adalah total data keseluruhan
                const cardHtml = `
                <img class="card-img-top"
                    src="${BASE_STORAGE_URL}/${response.flyer}"
                    alt="Card image" onerror="this.onerror=null; this.src='${BASE_URL}/img/logo_kemdikbud.png'">
                    <table class="table table-borderless w-100" style="table-layout: fixed;">
            <tbody>
                <tr>
                    <td class="col-4"><strong>Nama Kegiatan</strong></td>
                    <td class="col-4">: ${response.nama_kegiatan}</td>
                </tr>
                <tr>
                    <td class="col-4"><strong>TPK</strong></td>
                    <td class="col-4">: ${response.tpk}</td>
                </tr>
                <tr>
                    <td class="col-4"><strong>Tanggal</strong></td>
                    <td class="col-4">: ${formatTanggalSD(response.tanggal_mulai, response.tanggal_selesai)}</td>
                </tr>
                <tr>
                    <td class="col-4"><strong>Pola Kegiatan</strong></td>
                    <td class="col-4">: ${response.pola_kegiatan}</td>
                </tr>
                <tr>
                    <td class="col-4"><strong>Materi</strong></td>
                    <td class="col-4">: <a href="${response.materi}" class="btn btn-primary btn-sm" target="_blank">Lihat</a></td>
                </tr>
                <tr>
                    <td class="col-4"><strong>Dokumentasi</strong></td>
                    <td class="col-4">: <a href="${response.dokumentasi}" class="btn btn-secondary btn-sm" target="_blank">Lihat</a></td>
                </tr>
                <tr>
                    <td class="col-4"><strong>Panduan</strong></td>
                    <td class="col-4">: <a href="${response.panduan}" class="btn btn-info btn-sm" target="_blank">Lihat</a></td>
                </tr>
                <tr>
                    <td class="col-4"><strong>Jenis Kegiatan</strong></td>
                    <td class="col-4">: ${response.jenis_kegiatan}</td>
                </tr>
                <tr>
                    <td class="col-4"><strong>Kode Kegiatan</strong></td>
                    <td class="col-4">: ${response.kode_kegiatan}</td>
                </tr>
                <tr>
                    <td class="col-4"><strong>Honor Peserta</strong></td>
                    <td class="col-4">: ${h_peserta}</td>
                </tr>
                <tr>
                    <td class="col-4"><strong>Honor Panitia</strong></td>
                    <td class="col-4">: ${h_panitia}</td>
                </tr>
                <tr>
                    <td class="col-4"><strong>Honor Narasumber</strong></td>
                    <td class="col-4">: ${h_narasumber}</td>
                </tr>
                <tr>
                    <td class="col-4"><strong>Status</strong></td>
                    <td class="col-4">: <span class="badge ${response.status == 'Aktif' ? 'bg-success' : 'bg-danger'}">${response.status}</span></td>
                </tr>
                <tr>
                    <td colspan="2"> <strong>Tautan Form</strong><br>${urlForm(response.id, response.nama_kegiatan)}</td>
                </tr>
                <tr>
                    <td colspan="2"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalUbahKegiatan">Edit <i class="fa fa-pencil-square" aria-hidden="true"></i></button></td>
                </tr>
            </tbody>`;

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
        return `<br>Panitia : <a href='${BASE_URL}/form/${id}/panitia/${slug}' >${BASE_URL}/form/${id}/panitia/${slug}</a><br>
                Peserta : <a href='${BASE_URL}/form/${id}/peserta/${slug}' >${BASE_URL}/form/${id}/peserta/${slug}</a><br>
                Narasumber : <a href='${BASE_URL}/form/${id}/narasumber/${slug}' >${BASE_URL}/form/${id}/narasumber/${slug}</a><br>`;
    }
// });
