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
        @empty($warga)
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
                    <td>{{ $warga->nik }}</td>
                </tr>
                <tr>
                    <th>Level Warga</th>
                    <td>{{ $warga->level->nama_level }}</td>
                <tr>
                <tr>
                    <th>No. KK</th>
                    <td>{{ $warga->nokk }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $warga->nama }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $warga->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th>
                    <td>{{ $warga->tempat_lahir }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $warga->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $warga->alamat }}</td>
                </tr>
                <tr>
                    <th>Agama</th>
                    <td>{{ $warga->agama }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ $warga->status }}</td>
                </tr>
                <tr>
                    <th>Kewarganegaraan</th>
                    <td>{{ $warga->kewarganegaraan }}</td>
                </tr>
                <tr>
                    <th>Pendidikan</th>
                    <td>{{ $warga->pendidikan }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan</th>
                    <td>{{ $warga->pekerjaan }}</td>
                </tr>
                <tr>
                    <th>Status Pernikahan</th>
                    <td>{{ $warga->status_pernikahan }}</td>
                </tr>
                <tr>
                    <th>RT</th>
                    <td>{{ $warga->rt }}</td>
                </tr>
                <tr>
                    <th>RW</th>
                    <td>{{ $warga->rw }}</td>
            </table>
        @endempty
        <a href="{{ url('warga') }}" class="btn btn-sm btn-default mt-2">
            kembali
        </a>
    </div>
</div>
@endsection

@push('css')
    
@endpush

@push('js')
    
@endpush