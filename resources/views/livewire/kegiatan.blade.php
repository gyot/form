@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Agenda Kegiatan</h2>
    <form action="" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_kegiatan">Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" value="{{ $agendaKegiatan->nama_kegiatan }}" required>
        </div>
        <div class="form-group">
            <label for="tpk">TPK</label>
            <input type="text" name="tpk" class="form-control" value="{{ $agendaKegiatan->tpk }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ $agendaKegiatan->tanggal_mulai }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" name="tanggal_selesai" class="form-control" value="{{ $agendaKegiatan->tanggal_selesai }}" required>
        </div>
        <div class="form-group">
            <label for="pola_kegiatan">Pola Kegiatan</label>
            <input type="text" name="pola_kegiatan" class="form-control" value="{{ $agendaKegiatan->pola_kegiatan }}" required>
        </div>
        <div class="form-group">
            <label for="flyer">Flyer</label>
            <input type="file" name="flyer" class="form-control">
        </div>
        <div class="form-group">
            <label for="materi">Materi (URL)</label>
            <input type="url" name="materi" class="form-control" value="{{ $agendaKegiatan->materi }}">
        </div>
        <div class="form-group">
            <label for="dokumentasi">Dokumentasi (URL)</label>
            <input type="url" name="dokumentasi" class="form-control" value="{{ $agendaKegiatan->dokumentasi }}">
        </div>
        <div class="form-group">
            <label for="panduan">Panduan (URL)</label>
            <input type="url" name="panduan" class="form-control" value="{{ $agendaKegiatan->panduan }}">
        </div>
        <div class="form-group">
            <label for="jenis_kegiatan">Jenis Kegiatan</label>
            <input type="text" name="jenis_kegiatan" class="form-control" value="{{ $agendaKegiatan->jenis_kegiatan }}" required>
        </div>
        <div class="form-group">
            <label for="kode_kegiatan">Kode Kegiatan</label>
            <input type="text" name="kode_kegiatan" class="form-control" value="{{ $agendaKegiatan->kode_kegiatan }}" required>
        </div>
        <div class="form-group">
            <label for="id_user">ID User</label>
            <input type="number" name="id_user" class="form-control" value="{{ $agendaKegiatan->id_user }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection