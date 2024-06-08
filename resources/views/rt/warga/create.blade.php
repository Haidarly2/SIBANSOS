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
        <form action="{{ url('warga') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    Level
                </label>
                <div class="col-11">
                    <select name="id_level" class="form-control" id="id_level" required>
                        <option value="">-- Pilih Level --</option>
                        @foreach ($level as $item)
                            <option value="{{ $item->id_level }}">
                                {{ $item->nama_level }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_level')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    NIK
                </label>
                <div class="col-11">
                    <input type="text" name="nik" class="form-control" id="nik" value="{{ old('nik') }}" required>
                    @error('nik')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    No. KK
                </label>
                <div class="col-11">
                    <input type="text" name="nokk" class="form-control" id="nokk" value="{{ old('nokk') }}" required>
                    @error('nokk')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    Nama
                </label>
                <div class="col-11">
                    <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama') }}" required>
                    @error('nama')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    Jenis Kelamin
                </label>
                <div class="col-11">
                    <input type="text" name="jenis_kelamin" class="form-control" id="jenis_kelamin" value="{{ old('jenis_kelamin') }}" required>
                    @error('jenis_kelamin')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    Tempat Lahir
                </label>
                <div class="col-11">
                    <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                    @error('tempat_lahir')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    Tanggal Lahir
                </label>
                <div class="col-11">
                    <input type="date" name="tanggal_lahir" class="form-control" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                    @error('tanggal_lahir')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    Alamat
                </label>
                <div class="col-11">
                    <input type="text" name="alamat" class="form-control" id="alamat" value="{{ old('alamat') }}" required>
                    @error('alamat')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    Agama
                </label>
                <div class="col-11">
                    <input type="text" name="agama" class="form-control" id="agama" value="{{ old('agama') }}" required>
                    @error('agama')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    Status
                </label>
                <div class="col-11">
                    <input type="text" name="status" class="form-control" id="status" value="{{ old('status') }}" required>
                    @error('status')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    Kewarganegaraan
                </label>
                <div class="col-11">
                    <input type="text" name="kewarganegaraan" class="form-control" id="kewarganegaraan" value="{{ old('kewarganegaraan') }}" required>
                    @error('kewarganegaraan')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    Pekerjaan
                </label>
                <div class="col-11">
                    <input type="text" name="pekerjaan" class="form-control" id="pekerjaan" value="{{ old('pekerjaan') }}" required>
                    @error('pekerjaan')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                Pendidikan
                </label>
                <div class="col-11">
                    <input type="text" name="pendidikan" class="form-control" id="pendidikan" value="{{ old('pendidikan') }}" required>
                    @error('pendidikan')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                Status Pernikahan
                </label>
                <div class="col-11">
                    <input type="text" name="status_pernikahan" class="form-control" id="status_pernikahan" value="{{ old('status_pernikahan') }}" required>
                    @error('status_pernikahan')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    RT
                </label>
                <div class="col-11">
                    @if($rt)
                        <input type="text" name="rt" class="form-control" id="rt" value="{{ $rt }}" readonly required>
                    @else
                        <input type="text" name="rt" class="form-control" id="rt" value="{{ old('rt') }}" required>
                    @endif
                    @error('rt')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                RW
                </label>
                <div class="col-11">
                    <input type="text" name="rw" class="form-control" id="rw" value="{{ old('rw', '6') }}" readonly required>
                    @error('rw')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    
                </label>
                <div class="col-11">
                    <button type="submit" class="btn btn-primary btn-sm">
                        Simpan
                    </button>
                    <a href="{{ url('warga') }}" class="btn btn-sm btn-default ml-1">
                        Kembali
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
    
@endpush

@push('js')
    
@endpush