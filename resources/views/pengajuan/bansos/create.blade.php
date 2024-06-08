@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form action="{{ url('pengajuan-bansos') }}" method="POST" class="form-horizontal">
            @csrf
            <!-- Data Penerima -->
            <div class="form-group row">
                <label class="col-md-2 col-form-label control-label">NIK</label>
                <div class="col-md-10">
                    <input type="text" name="nik" class="form-control" value="{{ old('nik') }}" required>
                    @error('nik')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label control-label">No KK</label>
                <div class="col-md-10">
                    <input type="text" name="nokk" class="form-control" value="{{ old('nokk') }}" required>
                    @error('nokk')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label control-label">Nama</label>
                <div class="col-md-10">
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                    @error('nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label control-label">Pekerjaan Ayah</label>
                <div class="col-md-10">
                    <input type="text" name="pekerjaanx" class="form-control" value="{{ old('pekerjaanx') }}" required>
                    @error('pekerjaanx')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label control-label">Pekerjaan Ibu</label>
                <div class="col-md-10">
                    <input type="text" name="pekerjaany" class="form-control" value="{{ old('pekerjaany') }}" required>
                    @error('pekerjaany')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label control-label">Gaji Ayah</label>
                <div class="col-md-10">
                    <input type="number" name="gajix" class="form-control" value="{{ old('gajix') }}" required>
                    @error('gajix')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label control-label">Gaji Ibu</label>
                <div class="col-md-10">
                    <input type="number" name="gajiy" class="form-control" value="{{ old('gajiy') }}" required>
                    @error('gajiy')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label control-label">Kewarganegaraan</label>
                <div class="col-md-10">
                    <input type="text" name="kewarganegaraan" class="form-control" value="{{ old('kewarganegaraan') }}" required>
                    @error('kewarganegaraan')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <!-- Data Penerima -->
            <div class="form-group row">
                <label class="col-md-2 col-form-label control-label">PLN</label>
                <div class="col-md-10">
                    <input type="text" name="pln" class="form-control" value="{{ old('pln') }}" required>
                    @error('pln')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label control-label">PDAM</label>
                <div class="col-md-10">
                    <input type="number" name="pdam" class="form-control" value="{{ old('pdam') }}" required>
                    @error('pdam')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label control-label">Status Kesehatan</label>
                <div class="col-md-10">
                    <input type="number" name="status_kesehatan" class="form-control" value="{{ old('status_kesehatan') }}" required>
                    @error('status_kesehatan')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label control-label">Status Rumah</label>
                <div class="col-md-10">
                    <input type="number" name="status_rumah" class="form-control" value="{{ old('status_rumah') }}" required>
                    @error('status_rumah')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <input type="hidden" name="id_bansos" value="{{ $id_bansos }}">
            <input type="hidden" name="status" value="Pending">
            <div class="form-group row">
                <div class="col-md-10 offset-md-2">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a href="{{ url('pengajuan-bansos') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
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
