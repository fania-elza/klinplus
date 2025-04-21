@extends('layouts.app')

@section('title-content')
<h1>Layanan</h1>
@endsection

@section('content')
    <div class="container">
        <div class="btn-layanan">
            <a href="{{ route('layanan.create') }}" class="btn btn-primary">
                Tambah Pelanggan Baru
            </a>
        </div>
    </div>
    <div class="container-table">
        <div class="table-wrapper">
            <table class="staf-table">
                <thread>
                    <tr>
                        <th>#</th>
                        <th>Id Pricelist</th>
                        <th>Nama Layanan</th>
                        <th>Durasi</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </thread>
                <tbody>
                    @foreach ($layanans as $layanan )
                    <tr>
                        <td>{{ $loop->iterasion }}</td>
                        <td>{{ $layanan->id }}</td>
                        <td>{{ $layanan->nama_layanan }}</td>
                        <td>{{ $layanan->durasi }}</td>
                        <td>{{ number_format($layanan->harga, 0, ',', '.') }}</td>
                        <td>{{ $layanan->deskripsi }}</td>
                        <td>
                            <div class="action-button">
                                <a href="{{ route('#', $pelanggan->id) }}" class="edit-button" title="edit">
                                    Edit
                                </a>
                                <form action="{{ route('#', $pelanggan->id) }}" method="POST" class="delete-form">
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

