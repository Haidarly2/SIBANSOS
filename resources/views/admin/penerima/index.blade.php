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
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="id_bansos" name="id_bansos" required>
                                <option value="">- Semua -</option>
                                @foreach ($bansos as $item)
                                    <option value="{{ $item->bansos }}">{{ $item->nama_program }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Nama Program</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_penerima">
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Nama Program</th>
                        <th>No KK</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>RT/RW</th>
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
            var dataPenerima = $('#table_penerima').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('penerima/showup') }}",
                    "type": 'POST',
                    "data": function(d) {
                        d.id_bansos = $('#id_bansos').val();
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'bansos.nama_program', name: 'bansos.nama_program', orderable: true, searchable: true },
                    { data: 'user.nokk', name: 'user.nokk', orderable: false, searchable: true },
                    { data: 'user.nama', name: 'user.nama', orderable: false, searchable: true },
                    { data: 'user.alamat', name: 'user.alamat', orderable: false, searchable: true },
                    {
                        data: null,
                        name: 'user.rt_rw',
                        orderable: false,
                        searchable: true,
                        render: function(data, type, row) {
                            return row.user.rt + '/' + row.user.rw;
                        }
                    },
                    { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
                ]
            });

            $('#id_bansos').on('change', function() {
                dataPenerima.ajax.reload();
            });
        });
    </script>
@endpush
