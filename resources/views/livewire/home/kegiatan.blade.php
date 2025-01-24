@extends('livewire.home.app')

@section('content')
<div class="container ">    
    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modalTambahKegiatan">Tambah Kegiatan</button>
    <br><br>
    <div id="card-container" class="row daftar_kegitan">
    </div>
    <!-- Pagination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center mt-4" id="pagination">
    
        </ul>
    </nav>
</div>

    {{-- Modal input kegiatan --}}
    <!-- Modal -->
    <div class="modal fade" id="modalTambahKegiatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahKegiatan" method="POST" action="{{ route('kegiatan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Input Nama Kegiatan -->
                        <div class="form-group">
                            <label for="nama_kegiatan">Nama Kegiatan</label>
                            <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" required>
                        </div>

                        <!-- Input TPK -->
                        <div class="form-group">
                            <label for="tpk">TPK</label>
                            <input type="text" class="form-control" id="tpk" name="tpk" required>
                        </div>

                        <!-- Input Tanggal Mulai -->
                        <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                        </div>

                        <!-- Input Tanggal Selesai -->
                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                        </div>

                        <!-- Input Pola Kegiatan -->
                        <div class="form-group">
                            <label for="pola_kegiatan">Pola Kegiatan</label>
                            <input type="text" class="form-control" id="pola_kegiatan" name="pola_kegiatan" required>
                        </div>

                        <!-- Input Flyer -->
                        <div class="form-group">
                            <label for="flyer">Flyer</label>
                            <input type="file" class="form-control" id="flyer" name="flyer">
                        </div>

                        <!-- Input Materi -->
                        <div class="form-group">
                            <label for="materi">Materi</label>
                            <input type="url" class="form-control" id="materi" name="materi">
                        </div>

                        <!-- Input Dokumentasi -->
                        <div class="form-group">
                            <label for="dokumentasi">Link Dokumentasi</label>
                            <input type="url" class="form-control" id="dokumentasi" name="dokumentasi">
                        </div>

                        <!-- Input Panduan -->
                        <div class="form-group">
                            <label for="panduan">Panduan</label>
                            <input type="url" class="form-control" id="panduan" name="panduan">
                        </div>

                        <!-- Input Jenis Kegiatan -->
                        <div class="form-group">
                            <label for="jenis_kegiatan">Jenis Kegiatan</label>
                            <input type="text" class="form-control" id="jenis_kegiatan" name="jenis_kegiatan" required>
                        </div>
<!-- Input Puls -->
                        {{-- <div class="form-group">
                            <label for="pulsa">Pulsa</label>
                            <input type="checkbox" value="1" id="pulsa" name="pulsa">
                        </div> --}}
                        <!-- Input Puls -->
                        <label>Panitia</label>
                        <div class="form-group">
                            <label for="pulsa" class="font-weight-normal">Pulsa</label>
                            <input type="checkbox" value="1" id="pa_pulsa" name="pa_pulsa">
                            <label for="rekening" class="font-weight-normal">Rekening</label>
                            <input type="checkbox" value="2" id="pa_rekening" name="pa_rekening">
                        </div>

                        <label>Narasumber</label>
                        <div class="form-group">
                            <label for="pulsa" class="font-weight-normal">Pulsa</label>
                            <input type="checkbox" value="1" id="na_pulsa" name="na_pulsa">
                            <label for="rekening" class="font-weight-normal">Rekening</label>
                            <input type="checkbox" value="2" id="na_rekening" name="na_rekening">
                        </div>

                        <label>Peserta</label>
                        <div class="form-group">
                            <label for="pulsa" class="font-weight-normal">Pulsa</label>
                            <input type="checkbox" value="1" id="pe_pulsa" name="pe_pulsa">
                            <label for="rekening" class="font-weight-normal">Rekening</label>
                            <input type="checkbox" value="2" id="pe_rekening" name="pe_rekening">
                        </div>

                        <!-- Input ID User -->
                        <div class="form-group">
                            <input type="hidden" value="{{1}}" class="form-control" id="id_user" name="id_user" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- end Modal input kegiatan --}}
@endsection
@section('add_script')
    <script>
        fetchData(currentPage);
    </script>
@endsection