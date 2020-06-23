@extends('layouts.master')
@section('karyawan','active')
@section('data-tables-css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endsection
@section('content')
@section('button-add')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_pendidikan">
    <i class="fa fa-plus" aria-hidden="true"></i> Tambah
</button>
@endsection
<!-- Modal -->
<div class="modal fade" id="add_pendidikan" tabindex="-1" role="dialog" aria-labelledby="add_pendidikan_label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add_pendidikan_label">Tambah Data Pendidikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('karyawan.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nama_Karyawan">Nama Karyawan</label>
                            <input type="text" name="nama_Karyawan" id="nama_Karyawan"
                                class="form-control @error('nama_Karyawan') is-invalid @enderror"
                                value="{{ old('nama_Karyawan') }}">
                            @error('nama_Karyawan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gender">Jenis Kelamin</label>
                            <select name="gender" id="gender"
                                class="form-control @error('gender') is-invalid @enderror">
                                <option value="L"
                                    {{ old('gender')=='L'?'selected':'' }}>
                                    Laki-Laki</option>
                                <option value="P"
                                    {{ old('gender')=='P'?'selected':'' }}>
                                    Perempuan</option>
                            </select>
                            @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="umur">Umur</label>
                            <input type="number" name="umur" id="umur"
                                class="form-control @error('umur') is-invalid @enderror"
                                value="{{ old('umur') }}">
                            @error('umur')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="status_id">Status Karyawan</label>
                            <select name="status_id" id="status_id"
                                class="form-control @error('status_id') is-invalid @enderror">
                                @foreach($status as $stat)
                                    <option value="{{ $stat->id }}"
                                        {{ old('status_id')==$stat->id?'selected':'' }}>
                                        {{ $stat->status_karyawan }}</option>
                                @endforeach
                            </select>
                            @error('status_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="jabatan_id">Jabatan</label>
                            <select name="jabatan_id" id="jabatan_id"
                                class="form-control @error('jabatan_id') is-invalid @enderror">
                                @foreach($jabatan as $jab)
                                    <option value="{{ $jab->id }}"
                                        {{ old('jabatan_id')==$jab->id?'selected':'' }}>
                                        {{ $jab->nama_jabatan }}</option>
                                @endforeach
                            </select>
                            @error('jabatan_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pendidikan_id">Status Karyawan</label>
                            <select name="pendidikan_id" id="pendidikan_id"
                                class="form-control @error('pendidikan_id') is-invalid @enderror">
                                @foreach($pendidikan as $pen)
                                    <option value="{{ $pen->id }}"
                                        {{ old('pendidikan_id')==$pen->id?'selected':'' }}>
                                        {{ $pen->nama_pendidikan }}</option>
                                @endforeach
                            </select>
                            @error('pendidikan_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="no_hp">No HP</label>
                            <input type="number" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                                id="no_hp" value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<table id="table_id" class="display nowrap table">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Karyawan</th>
            <th>Jenis Kelamin</th>
            <th>Umur</th>
            <th>Status</th>
            <th>Jabatan</th>
            <th>Pendidikan</th>
            <th>No Telepon</th>
            <th>Tanggal Masuk</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_Karyawan }}</td>
                <td>{{ $item->gender=='L'?'Laki-Laki':'Perempuan' }}
                </td>
                <td>{{ $item->umur }}</td>
                <td>{{ $item->status->status_karyawan }}</td>
                <td>{{ $item->jabatan->nama_jabatan }}</td>
                <td>{{ $item->pendidikan->nama_pendidikan }}</td>
                <td>{{ $item->telepon->no_hp }}</td>
                <td>{{ $item->created_at }}</td>
                <td align="center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-toggle="modal"
                        data-target="#edit_karyawan{{ $loop->iteration }}">
                        <i class="fas fa-edit"></i> Ubah
                    </button>
                </td>
                <td align="center">
                    <form action="{{ route('karyawan.destroy',$item->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                    </form>
                </td>
                <div class="modal fade" id="edit_karyawan{{ $loop->iteration }}" tabindex="-1" role="dialog"
                    aria-labelledby="edit_karyawan_label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="edit_karyawan_label">Ubah Data Karyawan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('karyawan.update',$item->id) }}"
                                method="POST">
                                @method('PUT')
                                @csrf
                                <div class="modal-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="nama_Karyawan">Nama Karyawan</label>
                                            <input type="text" name="nama_Karyawan" id="nama_Karyawan"
                                                class="form-control @error('nama_Karyawan') is-invalid @enderror"
                                                value="{{ old('nama_Karyawan')??$item->nama_Karyawan }}">
                                            @error('nama_Karyawan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="gender">Jenis Kelamin</label>
                                            <select name="gender" id="gender"
                                                class="form-control @error('gender') is-invalid @enderror">
                                                <option value="L"
                                                    {{ (old('gender')??$item->gender)=='L'?'selected':'' }}>
                                                    Laki-Laki</option>
                                                <option value="P"
                                                    {{ (old('gender')??$item->gender)=='P'?'selected':'' }}>
                                                    Perempuan</option>
                                            </select>
                                            @error('gender')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="umur">Umur</label>
                                            <input type="number" name="umur" id="umur"
                                                class="form-control @error('umur') is-invalid @enderror"
                                                value="{{ old('umur')??$item->umur }}">
                                            @error('umur')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="status_id">Status Karyawan</label>
                                            <select name="status_id" id="status_id"
                                                class="form-control @error('status_id') is-invalid @enderror">
                                                @foreach($status as $stat)
                                                    <option value="{{ $stat->id }}"
                                                        {{ (old('status_id')??$item->status_id)==$stat->id?'selected':'' }}>
                                                        {{ $stat->status_karyawan }}</option>
                                                @endforeach
                                            </select>
                                            @error('status_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="jabatan_id">Jabatan</label>
                                            <select name="jabatan_id" id="jabatan_id"
                                                class="form-control @error('jabatan_id') is-invalid @enderror">
                                                @foreach($jabatan as $jab)
                                                    <option value="{{ $jab->id }}"
                                                        {{ (old('jabatan_id')??$item->jabatan_id)==$jab->id?'selected':'' }}>
                                                        {{ $jab->nama_jabatan }}</option>
                                                @endforeach
                                            </select>
                                            @error('jabatan_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="pendidikan_id">Status Karyawan</label>
                                            <select name="pendidikan_id" id="pendidikan_id"
                                                class="form-control @error('pendidikan_id') is-invalid @enderror">
                                                @foreach($pendidikan as $pen)
                                                    <option value="{{ $pen->id }}"
                                                        {{ (old('pendidikan_id')??$item->pendidikan_id)==$pen->id?'selected':'' }}>
                                                        {{ $pen->nama_pendidikan }}</option>
                                                @endforeach
                                            </select>
                                            @error('pendidikan_id')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="no_hp">No HP</label>
                                            <input type="number" name="no_hp"
                                                class="form-control @error('no_hp') is-invalid @enderror" id="no_hp"
                                                value="{{ old('no_hp')??$item->telepon->no_hp }}"
                                                required>
                                            @error('no_hp')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Perbaharui</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
@endsection
@section('data-tables-js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script>
    function format(d) {
        // `d` is the original data object for the row
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
            '<tr>' +
            '<td>Full name:</td>' +
            '<td>' + d.name + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Extension number:</td>' +
            '<td>' + d.extn + '</td>' +
            '</tr>' +
            '<tr>' +
            '<td>Extra info:</td>' +
            '<td>And any further details here (images etc)...</td>' +
            '</tr>' +
            '</table>';
    }

    $(document).ready(function () {
        var table = $('#example').DataTable({
            "ajax": "{{ url('../ajax/data/objects.txt') }}",
            "columns": [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {
                    "data": "name"
                },
                {
                    "data": "position"
                },
                {
                    "data": "office"
                },
                {
                    "data": "salary"
                }
            ],
            "order": [
                [1, 'asc']
            ]
        });

        // Add event listener for opening and closing details
        $('#example tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
    });

</script>
@endsection
