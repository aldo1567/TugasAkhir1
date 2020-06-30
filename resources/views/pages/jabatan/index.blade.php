@extends('layouts.master')
@section('jabatan','active')
@section('content')
<div class="container">
    @section('notif')
    @if(session('status'))
        <div class="{{ session('css') }}">
            {{ session('status') }}
        </div>
    @endif
    @endsection
    @section('button-add')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add_jabatan">
        <i class="fa fa-plus" aria-hidden="true"></i> Tambah
    </button>
    @endsection
    <!-- Modal -->
    <div class="modal fade" id="add_jabatan" tabindex="-1" role="dialog" aria-labelledby="add_jabatan_label"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add_jabatan_label">Tambah Data Jabatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jabatan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_jabatan">Jabatan</label>
                            <input type="text" name="nama_jabatan" id="nama_jabatan"
                                class="form-control @error('nama_jabatan') is-invalid @enderror"
                                value="{{ old('nama_jabatan') }}">
                            @error('nama_jabatan')
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
                <td>Nama Jabatan</td>
                <td colspan="2" align="center">Aksi</td>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @if($item->nama_jabatan=='Fullstack Developer')
                        <td>
                            <div class="btn btn-primary">{{ $item->nama_jabatan }}</div>
                        </td>
                    @elseif($item->nama_jabatan=='Frontend Developer')
                        <td>
                            <div class="btn btn-warning">{{ $item->nama_jabatan }}</div>
                        </td>
                    @elseif($item->nama_jabatan=='Backend Developer')
                        <td>
                            <div class="btn btn-danger">{{ $item->nama_jabatan }}</div>
                        </td>
                    @else
                        <td>
                            <div class="btn btn-secondary">{{ $item->nama_jabatan }}</div>
                        </td>
                    @endif
                    <td align="center">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#edit_jabatan{{ $loop->iteration }}">
                            <i class="fas fa-edit"></i> Ubah
                        </button>
                    </td>
                    <td align="center">
                        <form action="{{ route('jabatan.destroy',$item->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="edit_jabatan{{ $loop->iteration }}" tabindex="-1" role="dialog"
                        aria-labelledby="edit_jabatan_label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit_jabatan_label">Ubah Data Jabatan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('jabatan.update',$item->id) }}"
                                    method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama_jabatan">Jabatan</label>
                                            <input type="text" name="nama_jabatan" id="nama_jabatan"
                                                class="form-control @error('nama_jabatan') is-invalid @enderror"
                                                value="{{ (old('nama_jabatan') ?? $item->nama_jabatan) }}">
                                            @error('nama_jabatan')
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
