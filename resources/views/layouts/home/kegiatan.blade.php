@extends('layouts.home.master')

@section('content')
    {{-- @parent --}}
    <div class="container ">
        <div class="row daftar_kegitan">
            <!-- Card 1 -->
            <div class="card">
                <div class="blur-bg" 
                    style="background-image: url('https://bpmpntb.kemdikbud.go.id/sertifikat/assets/img/flyers/skpzhHWhatsApp_Image_2024-08-23_at_14.36.52.jpeg');">
                </div>
                <img class="card-img-top"
                    src="https://bpmpntb.kemdikbud.go.id/sertifikat/assets/img/flyers/skpzhHWhatsApp_Image_2024-08-23_at_14.36.52.jpeg"
                    alt="Card image">
                <div class="card-body">
                    <p><b>Pengolahan dan Analisis Data Hasil Pemantauan/Monitoring 
                        Persiapan dan Pelaksanaan AN/Sulingjar Tahun 2024</b></p>
                    <p class="card-text">
                        <img src="{{ asset('img/icons/calendar.png') }}" alt="Calendar Icon">
                        &nbsp; 20 January 2014 s.d. 23 January 2014
                    </p>
                    <p class="card-text">
                        <img src="{{ asset('img/icons/map.png') }}" alt="Map Icon">
                        &nbsp; Balai Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat
                    </p>
                    <a href="#" class="btn btn-primary">Detail</a>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card">
                <div class="blur-bg" 
                    style="background-image: url('https://bpmpntb.kemdikbud.go.id/sertifikat/assets/img/flyers/1Jp1qwWhatsApp_Image_2024-08-11_at_19.19.31.jpeg');">
                </div>
                <img class="card-img-top"
                    src="https://bpmpntb.kemdikbud.go.id/sertifikat/assets/img/flyers/1Jp1qwWhatsApp_Image_2024-08-11_at_19.19.31.jpeg"
                    alt="Card image">
                <div class="card-body">
                    <p><b>Pengolahan dan Analisis Data Hasil Pemantauan/Monitoring 
                        Persiapan dan Pelaksanaan AN/Sulingjar Tahun 2024</b></p>
                    <p class="card-text">
                        <img src="{{ asset('img/icons/calendar.png') }}" alt="Calendar Icon">
                        &nbsp; 20 January 2014 s.d. 23 January 2014
                    </p>
                    <p class="card-text">
                        <img src="{{ asset('img/icons/map.png') }}" alt="Map Icon">
                        &nbsp; Balai Penjaminan Mutu Pendidikan Provinsi Nusa Tenggara Barat
                    </p>
                    <a href="#" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>
    </div>
@endsection
