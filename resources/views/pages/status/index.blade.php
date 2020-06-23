@extends('layouts.master')
@section('status','active')
@section('content')
<div class="container">
    @section('button-add')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_status">
        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
    </button>
    @endsection

    <!-- Modal -->
    <div class="modal fade" id="add_status" tabindex="-1" role="dialog" aria-labelledby="add_status_label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_status_label">Tambah Data Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('status.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="status_karyawan">Status</label>
                            <select name="status_karyawan" id="status_karyawan"
                                class="form-control @error('status_karyawan') is-invalid @enderror">
                                <option value="Magang"
                                    {{ old('status_karyawan')=='Magang'?'selected':'' }}>
                                    Magang</option>
                                <option value="Kontrak"
                                    {{ old('status_karyawan')=='Kontrak'?'selected':'' }}>
                                    Kontrak</option>
                                <option value="Tetap"
                                    {{ old('status_karyawan')=='Tetap'?'selected':'' }}>
                                    Tetap</option>
                            </select>
                            @error('status_karyawan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
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
    <table class="table table-hover table-dark my-5">
        <thead>
            <tr>
                <td>#</td>
                <td>Status Karyawan</td>
                <td colspan="2" align="center">Aksi</td>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @if($item->status_karyawan=='Tetap')
                        <td>
                            <div class="btn btn-primary">{{ $item->status_karyawan }}</div>
                        </td>
                    @elseif($item->status_karyawan=='Kontrak')
                        <td>
                            <div class="btn btn-warning">{{ $item->status_karyawan }}</div>
                        </td>
                    @else
                        <td>
                            <div class="btn btn-danger">{{ $item->status_karyawan }}</div>
                        </td>
                    @endif
                    <td align="center">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#edit_status{{ $loop->iteration }}">
                            <i class="fas fa-edit"></i> Ubah
                        </button>
                    </td>
                    <td align="center">
                        <form action="{{ route('status.destroy',$item->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="edit_status{{ $loop->iteration }}" tabindex="-1" role="dialog"
                        aria-labelledby="edit_status_label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit_status_label">Ubah Data Status</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('status.update',$item->id) }}"
                                    method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="status_karyawan">Status</label>
                                            <select name="status_karyawan" id="status_karyawan"
                                                class="form-control @error('status_karyawan') is-invalid @enderror">
                                                <option value="Magang"
                                                    {{ (old('status_karyawan')??$item->status_karyawan)=='Magang'?'selected':'' }}>
                                                    Magang</option>
                                                <option value="Kontrak"
                                                    {{ (old('status_karyawan')??$item->status_karyawan)=='Kontrak'?'selected':'' }}>
                                                    Kontrak</option>
                                                <option value="Tetap"
                                                    {{ (old('status_karyawan')??$item->status_karyawan)=='Tetap'?'selected':'' }}>
                                                    Tetap</option>
                                            </select>
                                            @error('status_karyawan')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="alert alert-danger text-center">Data Kosong</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
