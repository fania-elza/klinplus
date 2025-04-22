@extends('layouts.app')

@section('title-content')
<h1>Order</h1>
@endsection

@section('content')
<div class="container">
    <div class="btn-petugas">
        <a href="#" class="btn btn-primary">
            Tambah Order Baru
        </a>
    </div>
</div>
<div class="container-table">
    <div class="table-wrapper">
        <table class="staf-table">
            <thread>
                <tr>
                    <th>#</th>
                    <th>Status</th>
                    <th>Id Order</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>Gmaps</th>
                    <th>Layanan</th>
                    <th>Tanggal Pembersihan</th>
                    <th>Waktu Pembersihan</th>
                    <th>Action</th>
                </tr>
            </thread>
        </table>
    </div>
</div>
@endsection
