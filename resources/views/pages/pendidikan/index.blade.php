@extends('layouts.master')
@section('pendidikan','active')
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
                <form action="{{ route('pendidikan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_pendidikan">Jenjang Pendidikan</label>
                            <select name="nama_pendidikan" id="nama_pendidikan"
                                class="form-control @error('nama_pendidikan') is-invalid @enderror">
                                <option value="SD"
                                    {{ old('nama_pendidikan')=='SD'?'selected':'' }}>
                                    SD</option>
                                <option value="SMP"
                                    {{ old('nama_pendidikan')=='SMP'?'selected':'' }}>
                                    SMP</option>
                                <option value="SMA"
                                    {{ old('nama_pendidikan')=='SMA'?'selected':'' }}>
                                    SMA</option>
                                <option value="D3"
                                    {{ old('nama_pendidikan')=='D3'?'selected':'' }}>
                                    D3</option>
                                <option value="S1"
                                    {{ old('nama_pendidikan')=='S1'?'selected':'' }}>
                                    S1</option>
                                <option value="S2"
                                    {{ old('nama_pendidikan')=='S2'?'selected':'' }}>
                                    S2</option>
                                <option value="S3"
                                    {{ old('nama_pendidikan')=='S3'?'selected':'' }}>
                                    S3</option>
                            </select>
                            @error('nama_pendidikan')
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
                <td>Jenjang Pendidikan</td>
                <td colspan="2" align="center">Aksi</td>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    @if($item->nama_pendidikan=='SD')
                        <td>
                            <div class="btn btn-secondary">{{ $item->nama_pendidikan }}</div>
                        </td>
                    @elseif($item->nama_pendidikan=='SMP')
                        <td>
                            <div class="btn btn-light">{{ $item->nama_pendidikan }}</div>
                        </td>
                    @elseif($item->nama_pendidikan=='SMA')
                        <td>
                            <div class="btn btn-danger">{{ $item->nama_pendidikan }}</div>
                        </td>
                    @elseif($item->nama_pendidikan=='D3')
                        <td>
                            <div class="btn btn-warning">{{ $item->nama_pendidikan }}</div>
                        </td>
                    @elseif($item->nama_pendidikan=='S1')
                        <td>
                            <div class="btn btn-info">{{ $item->nama_pendidikan }}</div>
                        </td>
                    @elseif($item->nama_pendidikan=='S2')
                        <td>
                            <div class="btn btn-success">{{ $item->nama_pendidikan }}</div>
                        </td>
                    @elseif($item->nama_pendidikan=='S3')
                        <td>
                            <div class="btn btn-primary">{{ $item->nama_pendidikan }}</div>
                        </td>
                    @endif
                    <td align="center">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#edit_pendidikan{{ $loop->iteration }}">
                            <i class="fas fa-edit"></i> Ubah
                        </button>
                    </td>
                    <td align="center">
                        <form action="{{ route('pendidikan.destroy',$item->id) }}"
                            method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="edit_pendidikan{{ $loop->iteration }}" tabindex="-1" role="dialog"
                        aria-labelledby="edit_pendidikan_label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="edit_pendidikan_label">Ubah Data Pendidikan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('pendidikan.update',$item->id) }}"
                                    method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="nama_pendidikan">Jenjang Pendidikan</label>
                                            <select name="nama_pendidikan" id="nama_pendidikan"
                                                class="form-control @error('nama_pendidikan') is-invalid @enderror">
                                                <option value="SD"
                                                    {{ (old('nama_pendidikan')??$item->nama_pendidikan)=='SD'?'selected':'' }}>
                                                    SD</option>
                                                <option value="SMP"
                                                    {{ (old('nama_pendidikan')??$item->nama_pendidikan)=='SMP'?'selected':'' }}>
                                                    SMP</option>
                                                <option value="SMA"
                                                    {{ (old('nama_pendidikan')??$item->nama_pendidikan)=='SMA'?'selected':'' }}>
                                                    SMA</option>
                                                <option value="D3"
                                                    {{ (old('nama_pendidikan')??$item->nama_pendidikan)=='D3'?'selected':'' }}>
                                                    D3</option>
                                                <option value="S1"
                                                    {{ (old('nama_pendidikan')??$item->nama_pendidikan)=='S1'?'selected':'' }}>
                                                    S1</option>
                                                <option value="S2"
                                                    {{ (old('nama_pendidikan')??$item->nama_pendidikan)=='S2'?'selected':'' }}>
                                                    S2</option>
                                                <option value="S3"
                                                    {{ (old('nama_pendidikan')??$item->nama_pendidikan)=='S3'?'selected':'' }}>
                                                    S3</option>
                                            </select>
                                            @error('nama_pendidikan')
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
