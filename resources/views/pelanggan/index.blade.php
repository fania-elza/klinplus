@extends('layouts.app')

@section('title-content')
<h1>Pelanggan</h1>
@endsection

@section('content')
    <div class="container">
        <div class="btn-pelanggan">
            <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
                Tambah Pelanggan Baru
            </a>
        </div> 
    </div>
    <div class="container-table">
        <div class="table-wrapper">
            <table class="customer-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Id Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Nomor Telepon</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pelanggans as $pelanggan)
                        <tr>
                            <td>{{ $loop->iterasion }}</td>
                            <td>{{ $pelanggan->id }}</td>
                            <td>{{ $pelanggan->nama_pelanggan }}</td>
                            <td>{{ $pelanggan->nomor_telepon }}</td>
                            <td>{{ $pelanggan->email }}</td>
                            <td>
                                <div class="action-button">
                                    <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="edit-button" title="edit">
                                        Edit
                                    </a>
                                    <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection