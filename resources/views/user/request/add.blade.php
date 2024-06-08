@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">
            {{-- {{ $page->title }} --}}Buat Request
        </h3>
        <div class="card-tools">

        </div>
    </div>
    <div class="card-body">
        <form action="{{ url('request') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    Level
                </label>
                <div class="col-11">
                    <select name="id_bansos" class="form-control" id="id_bansos" required>
                        <option value="">-- Pilih Program --</option>
                        @foreach ($bansos as $item)
                            <option value="{{ $item->id_bansos }}">
                                {{ $item->nama_program }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_bansos')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    nama
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
                    Usia
                </label>
                <div class="col-11">
                    <input type="text" name="usia" class="form-control" id="usia" value="{{ old('usia') }}" required>
                    @error('usia')
                        <small class="form-text text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-1 col-form-label control-label">
                    No Telepon
                </label>
                <div class="col-11">
                    <input type="text" name="notelp" class="form-control" id="notelp" value="{{ old('notelp') }}" required>
                    @error('notelp')
                        <small class="form-text text-danger">
                            {{ $message }}
</div>
@endsection