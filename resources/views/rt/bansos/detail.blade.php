@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">
            {{ $page->title }}
        </h3>
        <div class="card-tools">

        </div>
    </div>
    <div class="card-body">
        @empty($penerima)
            <div class="alert alert-danger alert-dismissible">
                <h5>
                    <i class="icon fas fa-ban">
                        Kesalahan!
                    </i>
                    Data yang anda cari tidak ditemukan!
                </h5>
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm" id="table_penerima">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama Program</th>
                        <th>No KK</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>RT/RW</th>
                        <th>Skor EDAS</th>
                        <th>Skor SAW</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($penerima as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->bansos->nama_program }}</td>
                            <td>{{ $data->user->nokk }}</td>
                            <td>{{ $data->user->nama }}</td>
                            <td>{{ $data->user->alamat }}</td>
                            <td>{{ $data->user->rt }}/{{ $data->user->rw }}</td>
                            <td>{{ $data->skoredas }}</td>
                            <td>{{ $data->skoresaw }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endempty
        <a href="{{ url('bansos') }}" class="btn btn-sm btn-default mt-2">
            Kembali
        </a>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#table_penerima').DataTable();
        });
    </script>
@endpush
