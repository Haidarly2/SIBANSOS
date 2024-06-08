@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">
                {{ $page->title }}
            </h3>
            <div class="card-tools">
                <!-- Any additional tools or buttons can be placed here -->
            </div>
        </div>
        <div class="card-body">
            @empty($warga)
                <div class="alert alert-danger alert-dismissible">
                    <h5>
                        <i class="icon fas fa-ban"></i>
                        Kesalahan! Data yang Anda cari tidak ditemukan!
                    </h5>
                </div>
                <a href="{{ url('warga') }}" class="btn btn-sm btn-default mt-2">
                    Kembali
                </a>
            @else
                <form action="{{ url('/warga/' . $warga->id_warga) }}" method="POST" class="form-horizontal">
                    @csrf
                    @method('PUT') <!-- Lebih prefer untuk menggunakan @method('PUT') -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Level</label>
                        <div class="col-11">
                            <select name="id_level" id="id_level" class="form-control" required>
                                <option value="">- Pilih Level -</option>
                                @foreach ($level as $item)
                                    <option value="{{ $item->id_level }}"
                                        {{ $item->id_level == $warga->id_level ? 'selected' : '' }}>
                                        {{ $item->nama_level }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_level')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <!-- Sisipkan formulir lainnya di sini -->
                    <!-- Saya hanya memperbaiki satu bagian formulir di atas sebagai contoh -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">NIK</label>
                        <div class="col-11">
                            <input type="text" name="nik" id="nik" class="form-control" 
                            value="{{ old('nik') ?? $warga->nik }}" required>
                            @error('nik')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">NO. KK</label>
                        <div class="col-11">
                            <input type="text" name="nokk" id="nokk" class="form-control" 
                            value="{{ old('nokk') ?? $warga->nokk }}" required>
                            @error('nokk')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <!-- Lanjutkan formulir di sini -->
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Nama</label>
                        <div class="col-11">
                            <input type="text" name="nama" id="nama" class="form-control"
                                value="{{ old('nama') ?? $warga->nama }}" required>
                            @error('nama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Jenis Kelamin</label>
                        <div class="col-11">
                            <input type="text" name="jenis_kelamin" id="jenis_kelamin" class="form-control"
                                value="{{ old('jenis_kelamin') ?? $warga->jenis_kelamin }}" required>
                            @error('jenis_kelamin')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tempat Lahir</label>
                        <div class="col-11">
                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                value="{{ old('tempat_lahir') ?? $warga->tempat_lahir }}" required>
                            @error('tempat_lahir')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Tanggal Lahir</label>
                        <div class="col-11">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                                value="{{ old('tanggal_lahir') ?? $warga->tanggal_lahir }}" required>
                            @error('tanggal_lahir')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Alamat</label>
                        <div class="col-11">
                            <input type="text" name="alamat" id="alamat" class="form-control"
                                value="{{ old('alamat') ?? $warga->alamat }}" required>
                            @error('alamat')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Agama</label>
                        <div class="col-11">
                            <input type="text" name="agama" id="agama" class="form-control"
                                value="{{ old('agama') ?? $warga->agama }}" required>
                            @error('agama')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Kewarganegaraan</label>
                        <div class="col-11">
                            <input type="text" name="kewarganegaraan" id="kewarganegaraan" class="form-control"
                                value="{{ old('kewarganegaraan') ?? $warga->kewarganegaraan }}" required>
                            @error('kewarganegaraan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Pekerjaan</label>
                        <div class="col-11">
                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control"
                                value="{{ old('pekerjaan') ?? $warga->pekerjaan }}" required>
                            @error('pekerjaan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Pendidikan</label>
                        <div class="col-11">
                            <input type="text" name="pendidikan" id="pendidikan" class="form-control"
                                value="{{ old('pendidikan') ?? $warga->pendidikan }}" required>
                            @error('pendidikan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Status Pernikahan</label>
                        <div class="col-11">
                            <input type="text" name="status_pernikahan" id="status_pernikahan" class="form-control"
                                value="{{ old('status_pernikahan') ?? $warga->status_pernikahan }}" required>
                            @error('status_pernikahan')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">RT</label>
                        <div class="col-11">
                            <input type="text" name="rt" id="rt" class="form-control"
                                value="{{ old('rt') ?? $warga->rt }}" required>
                            @error('rt')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">RW</label>
                        <div class="col-11">
                            <input type="text" name="rw" id="rw" class="form-control"
                                value="{{ old('rw') ?? $warga->rw }}" required>
                            @error('rw')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a href="{{ url('warga') }}" class="btn btn-default btn-sm ml-1">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
