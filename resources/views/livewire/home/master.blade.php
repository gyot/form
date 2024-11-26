@extends('livewire.home.app')

@section('content')
    <div class="row">
        <div class="col-12">            
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data Dashboard</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Tanggal</th>
                                <th>Pengguna</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($dashboard as $item)
                                <tr>
                                    <td>{{ $item->nomor }}</td>
                                    <td>{{ date('d M Y H:i:s', strtotime($item->tanggal)) }}</td>
                                    <td>{{ $item->pengguna }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary">View</a>
                                        <a href="#" class="btn btn-sm btn-info">Edit</a>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('Hapus Data', '{{ $item->nomor }}')">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
@endpush
