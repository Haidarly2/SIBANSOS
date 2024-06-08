@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            {{-- Filter RT --}}
            @if ($userLevel != 2)
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <label class="col-1 control-label col-form-label">Filter RT:</label>
                            <div class="col-3">
                                <select class="form-control" id="rt" name="rt" required>
                                    <option value="">- Semua -</option>
                                    @foreach ($rts as $rt)
                                        <option value="{{ $rt->rt }}">{{ $rt->rt }}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">RT</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            {{-- Tabel Warga --}}
            <table class="table table-bordered table-striped table-hover table-sm" id="table_riwayat">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>RT</th>
                        <th>RW</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            var dataRiwayat = $('#table_riwayat').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('riwayat/list') }}",
                    "type": 'POST',
                    "data": function(d) {
                        d.rt = $('#rt').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nik',
                        name: 'nik',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'alamat',
                        name: 'alamat',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'rt',
                        name: 'rt',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'rw',
                        name: 'rw',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'level.nama_level',
                        name: 'level.nama_level',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#rt').on('change', function() {
                dataRiwayat.ajax.reload();
            });
        });
    </script>
@endpush
