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
