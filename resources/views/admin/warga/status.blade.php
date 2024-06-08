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
                <form action="{{ url('/warga/' . $warga->id_warga . '/update_status') }}" method="POST" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Status</label>
                        <div class="col-11">
                            <input type="text" name="status" id="status" class="form-control" 
                            value="{{ old('status') ?? $warga->status }}" required>
                            @error('status')
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