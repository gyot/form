<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            background-color: #f7f7f7;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-weight: bold;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            border-radius: 20px;
            border: 1px solid #ced4da;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn-primary, .btn-warning {
            border-radius: 20px;
        }
        .alert {
            border-radius: 5px;
        }
        .signature-pad {
            border-radius: 10px;
            background-color: #f8f9fa;
        }
        .signature-pad-container {
            position: relative;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
        }
        .signature-pad-container {
            position: relative;
            width: 100%; /* Responsif: lebar penuh container */
            height: 0;
            padding-bottom: 50%; /* Mengatur rasio 2:1 (lebar x tinggi) */
            border: 1px solid #000;
            border-radius: 10px;
            background-color: #f8f9fa;
        }

        .signature-pad {
            position: absolute;
            width: 300px;
            height: 200px;
        }

        #ttd_field{
            height: 250px;
        }
        .card {
            width: 100%;
            border: 1px solid #ddd;
            overflow: hidden;
            padding: 0px;
        }

        .card-img-top {
            width: 100%;
            height: 400px;
            object-fit: contain; /* Gambar proporsional sesuai orientasi */
            background: linear-gradient(6deg, rgb(85, 150, 203) 0%, rgb(190, 208, 245) 48%);
        }
    </style>
</head>

<body>
    <div class="container card">
        <img class="card-img-top" src="data:{{ $mimeType }};base64,{{ $imageData }}" alt="Image" alt="{{$nama_kegiatan}}" onerror="this.onerror=null; this.src='https://bpmpntb.kemdikbud.go.id/img/header_form.jpg'">
    </div>
    <div class="container mt-5" style="margin-top: 0%">
        <h3 class="text-center">FORMULIR BIODATA {{strtoupper($status)}} </h3>
        <h5 class="text-center">{{strtoupper($nama_kegiatan)}}</h5>
        <br><br>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('form_data.store') }}" method="post">
            @csrf
            <!-- Semua field input sebelumnya -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="hidden" name="id_kegiatan" value="{{$id_kegiatan}}">
                    <label for="nama">Nama Lengkap:</label>
                    <input type="text" @if ($errors->has('nama')) style="border-color:red" @endif class="form-control" id="nama" name="nama" value="{{old('nama')}}" placeholder="Masukkan Nama"
                    >
                    @if ($errors->has('nama'))
                    <p style="color:red">* {{ $errors->first('nama') }}</p>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nip">NIP:</label>
                    <input type="number" min="0" step="1" @if ($errors->has('nip')) style="border-color:red" @endif class="form-control angka" id="nip" name="nip" value="{{old('nip')}}" placeholder="Masukkan NIP"
                        >
                    @if ($errors->has('nip'))
                        <p style="color:red">* {{ $errors->first('nip') }}</p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email">Surel:</label>
                    <input @if ($errors->has('email')) style="border-color:red" @endif type="email" class="form-control" id="email" name="email" value="{{old('email')}}"
                        placeholder="Contoh: surel@doamin.com" >
                        @if ($errors->has('email'))
                    <p style="color:red">* {{ $errors->first('email') }}</p>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                    <select @if ($errors->has('jenis_kelamin')) style="border-color:red" @endif id="jenis_kelamin" name="jenis_kelamin" class="form-control" >
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    @if ($errors->has('jenis_kelamin'))
                    <p style="color:red">* {{ $errors->first('jenis_kelamin') }}</p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tempat_lahir">Tempat Lahir:</label>
                    <input type="text" @if ($errors->has('tempat_lahir')) style="border-color:red" @endif class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{old('tempat_lahir')}}"
                        placeholder="Contoh: Mataram" >
                        @if ($errors->has('tempat_lahir'))
                    <p style="color:red">* {{ $errors->first('tempat_lahir') }}</p>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                    <input type="date" @if ($errors->has('tanggal_lahir')) style="border-color:red" @endif class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{old('tanggal_lahir')}}" >
                    @if ($errors->has('tanggal_lahir'))
                    <p style="color:red">* {{ $errors->first('tanggal_lahir') }}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_instansi">Nama Instansi:</label>
                    <input type="text" @if ($errors->has('nama_instansi')) style="border-color:red" @endif class="form-control" id="nama_instansi" name="nama_instansi" value="{{old('nama_instansi')}}"
                        placeholder="Contoh: BPMP Provinsi NTB">
                        @if ($errors->has('nama_instansi'))
                        <p style="color:red">* {{ $errors->first('nama_instansi') }}</p>
                        @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jabatan">Jabatan:</label>
                    <input type="text" @if ($errors->has('jabatan')) style="border-color:red" @endif class="form-control" id="jabatan" name="jabatan" value="{{old('jabatan')}}"
                        placeholder="Contoh: Kepala BPMP Provinsi NTB" >
                        @if ($errors->has('jabatan'))
                    <p style="color:red">* {{ $errors->first('jabatan') }}</p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="pangkat_golongan">Pangkat/Golongan:</label>
                    <select @if ($errors->has('pangkat_golongan')) style="border-color:red" @endif class="form-control" id="pangkat_golongan" name="pangkat_golongan" >
                        <option value="">Pilih Pangkat/Golongan</option>
                        <option value="Non ASN">Non ASN</option>
                        <option value="" disabled><b>Pangkat/Golongan PNS</b></option>
                        <option value="Juru Muda / Ia">Juru Muda / Ia</option>
                        <option value="Juru Muda Tingkat I / Ib">Juru Muda Tingkat I / Ib</option>
                        <option value="Juru / Ic">Juru / Ic</option>
                        <option value="Juru Tingkat I / Id">Juru Tingkat I / Id</option>
                        <option value="Pengatur Muda / IIa">Pengatur Muda / IIa</option>
                        <option value="Pengatur Muda Tingkat I / IIb">Pengatur Muda Tingkat I / IIb</option>
                        <option value="Pengatur / IIc">Pengatur / IIc</option>
                        <option value="Pengatur Tingkat I / IId">Pengatur Tingkat I / IId</option>
                        <option value="Penata Muda / IIIa">Penata Muda / IIIa</option>
                        <option value="Penata Muda Tingkat I / IIIb">Penata Muda Tingkat I / IIIb</option>
                        <option value="Penata / IIIc">Penata / IIIc</option>
                        <option value="Penata Tingkat I / IIId">Penata Tingkat I / IIId</option>
                        <option value="Pembina / IVa">Pembina / IVa</option>
                        <option value="Pembina Tingkat I / IVb">Pembina Tingkat I / IVb</option>
                        <option value="Pembina Utama Muda / IVc">Pembina Utama Muda / IVc</option>
                        <option value="Pembina Utama Madya / IVd">Pembina Utama Madya / IVd</option>
                        <option value="Pembina Utama / IVe">Pembina Utama / IVe</option>
                        <option value="" disabled><b>Pangkat/Golongan PPPK</b></option>
                        <option value="PPPK Golongan I">PPPK Golongan I</option>
                        <option value="PPPK Golongan IV">PPPK Golongan IV</option>
                        <option value="PPPK Golongan V">PPPK Golongan V</option>
                        <option value="PPPK Golongan VI">PPPK Golongan VI</option>
                        <option value="PPPK Golongan IX">PPPK Golongan IX</option>
                        <option value="PPPK Golongan X">PPPK Golongan X</option>
                        <option value="PPPK Golongan XI">PPPK Golongan XI</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <div class="otherField" style="display: none;">
                        <label for="pangkat_golongan_lain">Masukkan Pangkat/Golongan</label>
                        <input type="text" class="form-control" id="pangkat_golongan_lain"
                            name="pangkat_golongan_lain">
                    </div>
                    @if ($errors->has('pangkat_golongan'))
                        <p style="color:red">* {{ $errors->first('pangkat_golongan') }}</p>
                        @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label for="pendidikan_terakhir">Pendidikan Terakhir:</label>
                    <select @if ($errors->has('pendidikan_terakhir')) style="border-color:red" @endif class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{old('pendidikan_terakhir')}}" >
                        <option value="">Pilih Pendidikan Terakhir</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="D1">D1</option>
                        <option value="D2">D2</option>
                        <option value="D3">D3</option>
                        <option value="D4/S1">D4/S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <div class="otherField" style="display: none;">
                        <label for="pendidikan_terakhir_lain">Masukkan Pendidikan Terakhir</label>
                        <input type="text" class="form-control" id="pendidikan_terakhir_lain"
                            name="pendidikan_terakhir_lain">
                    </div>
                    @if ($errors->has('pendidikan_terakhir'))
                        <p style="color:red">* {{ $errors->first('pendidikan_terakhir') }}</p>
                        @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="no_hp">No. HP / WA:</label>
                    <input type="text" @if ($errors->has('no_hp')) style="border-color:red" @endif class="form-control angka" id="no_hp" name="no_hp" value="{{old('no_hp')}}"
                        placeholder="Contoh: 0123456789">
                        @if ($errors->has('no_hp'))
                    <p style="color:red">* {{ $errors->first('no_hp') }}</p>
                    @endif
                </div>
                @if ($pulsa==1)
                <div class="col-md-6 mb-3">
                    <label for="provider">Provider</label>
                    <input type="text" @if ($errors->has('provider')) style="border-color:red" @endif class="form-control" id="provider" name="provider" value="{{old('provider')}}"
                        placeholder="contoh: XL, XL Prabayar, Telkomsel, dll" >
                        @if ($errors->has('provider'))
                    <p style="color:red">* {{ $errors->first('provider') }}</p>
                    @endif
                </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="agama">Agama:</label>
                    <select @if ($errors->has('agama')) style="border-color:red" @endif class="form-control" id="agama" name="agama" value="{{old('agama')}}" >
                        <option value="">Pilih Agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Konghucu">Konghucu</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <div class="otherField" style="display: none;">
                        <label for="agama_lain">Masukkan Agama</label>
                        <input type="text" class="form-control" id="agama_lain" name="agama_lain">
                    </div>
                    @if ($errors->has('agama'))
                        <p style="color:red">* {{ $errors->first('agama') }}</p>
                        @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label for="kabupaten_kota">Kabupaten/Kota:</label>
                    <select @if ($errors->has('kabupaten_kota')) style="border-color:red" @endif class="form-control" id="kabupaten_kota" name="kabupaten_kota" value="{{old('kabupaten_kota')}}" >
                        <option value="">Pilih Kabupaten/Kota</option>
                        <option value="Kabupaten Bima">Kabupaten Bima</option>
                        <option value="Kabupaten Dompu">Kabupaten Dompu</option>
                        <option value="Kabupaten Lombok Barat">Kabupaten Lombok Barat</option>
                        <option value="Kabupaten Lombok Tengah">Kabupaten Lombok Tengah</option>
                        <option value="Kabupaten Lombok Timur">Kabupaten Lombok Timur</option>
                        <option value="Kabupaten Lombok Utara">Kabupaten Lombok Utara</option>
                        <option value="Kabupaten Sumbawa">Kabupaten Sumbawa</option>
                        <option value="Kabupaten Sumbawa Barat">Kabupaten Sumbawa Barat</option>
                        <option value="Kota Bima">Kota Bima</option>
                        <option value="Kota Mataram">Kota Mataram</option>

                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <div class="otherField" style="display: none;">
                        <label for="kabupaten_kota_lain">Masukkan Kabupaten/Kota:</label>
                        <input type="text" class="form-control" id="kabupaten_kota_lain"
                            name="kabupaten_kota_lain">
                    </div>
                    @if ($errors->has('kabupaten_kota'))
                        <p style="color:red">* {{ $errors->first('kabupaten_kota') }}</p>
                        @endif
                </div>
            </div>
            @if ($rekening==1)
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nomor_rekening">Nomor Rekening</label>
                    <input type="number" @if ($errors->has('nomor_rekening')) style="border-color:red" @endif class="form-control angka" id="nomor_rekening" name="nomor_rekening" value="{{old('nomor_rekening')}}"
                        placeholder="123123123" >
                        @if ($errors->has('nomor_rekening'))
                        <p style="color:red">* {{ $errors->first('nomor_rekening') }}</p>
                        @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nama_bank">Nama Bank</label>
                    <input type="text" @if ($errors->has('nama_bank')) style="border-color:red" @endif class="form-control" id="nama_bank" name="nama_bank" value="{{old('nama_bank')}}"
                        placeholder="BNI, BRI, Mandiri, dll" >
                        @if ($errors->has('nama_bank'))
                        <p style="color:red">* {{ $errors->first('nama_bank') }}</p>
                        @endif
                </div>
            </div>                
            @endif
            <!-- Field tanda tangan -->
            <div id="ttd_field" @if ($errors->has('tanda_tangan')) style="border-color:red" @endif class="form-group">
                <label for="tanda_tangan">Tanda Tangan:</label><br>
                <canvas @if ($errors->has('tanda_tangan')) style="border: 1px solid red; !important" @else style="border: 1px solid #000;" @endif  id="signature-pad" class="signature-pad" width=400 height=200 
                    ></canvas>
                <input type="hidden" @if ($errors->has('tanda_tangan')) style="border-color:red" @endif name="tanda_tangan" id="tanda_tangan">
                @if ($errors->has('tanda_tangan'))
                    <p style="color:red">* {{ $errors->first('tanda_tangan') }}</p>
                    @endif
            </div>
            <button type="button" class="btn btn-warning" id="clear-signature">Hapus</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        
        var canvas = document.getElementById('signature-pad');
        var signaturePad = new SignaturePad(canvas);

        // Fungsi untuk menyesuaikan ukuran kanvas
        function resizeCanvas() {
            var ratio = Math.max(window.devicePixelRatio || 1, 1);
            // Tentukan lebar dan tinggi dari container
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }

        // Panggil resizeCanvas saat pertama kali dimuat dan saat ukuran layar berubah
        window.addEventListener('resize', resizeCanvas);
        resizeCanvas(); // Inisialisasi pertama kali

        // Tombol clear untuk menghapus tanda tangan
        document.getElementById('clear-signature').addEventListener('click', function () {
            signaturePad.clear();
        });

        // Tangani pengiriman form dengan tanda tangan
        document.querySelector('form').addEventListener('submit', function () {
            if (!signaturePad.isEmpty()) {
                var dataUrl = signaturePad.toDataURL();
                document.getElementById('tanda_tangan').value = dataUrl;
            } else {
                alert('Silakan buat tanda tangan sebelum mengirim!');
                return false; // Cegah pengiriman form
            }
        });


        $('select').change(function() {
            var selectedOption = $(this).val();
            var otherField = $(this).parent().find('.otherField');
            var otherFieldInput = otherField.find('input');

            // Show the text field and insert the value from the selected option
            // otherFieldInput.val(selectedOption);

            if (selectedOption === 'Lainnya') {
                otherField.show();
                otherFieldInput.val('');
            } else {
                otherField.hide();
                otherFieldInput.val(selectedOption);
            }

            // Show the text field (optional, only if you want to display it after selection)

        });

        $('.angka').on('keydown', function(event) {
                if (event.key === 'e' || event.key === 'E') {
                    event.preventDefault();
                }
            });
    </script>
</body>

</html>
