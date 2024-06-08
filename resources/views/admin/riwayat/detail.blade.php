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
        @empty($riwayat)
            <div class="alert alert-danger alert-dismissible">
                <h5>
                    <i class="icon fas fa-ban">
                        Kesalahan!
                    </i>
                    Data yang anda cari tidak ditemukan!
                </h5>
            </div>
            @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>NIK</th>
                    <td>{{ $riwayat->nik }}</td>
                </tr>
                <tr>
                    <th>Level Warga</th>
                    <td>{{ $riwayat->level->nama_level }}</td>
                <tr>
                <tr>
                    <th>No. KK</th>
                    <td>{{ $riwayat->nokk }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $riwayat->nama }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $riwayat->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th>
                    <td>{{ $riwayat->tempat_lahir }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $riwayat->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $riwayat->alamat }}</td>
                </tr>
                <tr>
                    <th>Agama</th>
                    <td>{{ $riwayat->agama }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $riwayat->status }}</td>
                </tr>
                <tr>
                    <th>Kewarganegaraan</th>
                    <td>{{ $riwayat->kewarganegaraan }}</td>
                </tr>
                <tr>
                    <th>Pendidikan</th>
                    <td>{{ $riwayat->pendidikan }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan</th>
                    <td>{{ $riwayat->pekerjaan }}</td>
                </tr>
                <tr>
                    <th>Status Pernikahan</th>
                    <td>{{ $riwayat->status_pernikahan }}</td>
                </tr>
                <tr>
                    <th>RT</th>
                    <td>{{ $riwayat->rt }}</td>
                </tr>
                <tr>
                    <th>RW</th>
                    <td>{{ $riwayat->rw }}</td>
            </table>
        @endempty
        <a href="{{ url('riwayat') }}" class="btn btn-sm btn-default mt-2">
            kembali
        </a>
    </div>
</div>
@endsection

@push('css')
    
@endpush

@push('js')
    
@endpush