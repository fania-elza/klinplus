@extends('layouts.app')

@section('title-content')
<h1>Jadwal</h1>
@endsection

@section('content')
<div class="container-table">
    <div class="table-wrapper">
        <table class="staf-table">
            <thread>
                <tr>
                    <th>#</th>
                    <th>Id Order</th>
                    <th>Nama Pelanggan</th>
                    <th>Layanan</th>
                    <th>Lokasi Pemesanan</th>
                    <th>Tanggal Pembersihan</th>
                    <th>Durasi Pembersihan</th>
                    <th>Nama Petugas</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Action</th>
                </tr>
            </thread>
        </table>
    </div>
</div>
@endsection
