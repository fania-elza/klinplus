@extends('layouts.app')

@section('title-content')
<h1>Layanan</h1>
@endsection

@section('content')
    <div class="container">
        <div class="btn-layanan">
            <a href="#" class="btn btn-primary">
                Tambah Layanan Baru
            </a>
        </div>
    </div>
    <div class="container-table">
        <div class="table-wrapper">
            <table class="staf-table">
                <thread>
                    <tr>
                        <th>#</th>
                        <th>Id Petugas</th>
                        <th>Nama Petugas</th>
                        <th>Nomor Telepon</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thread>
            </table>
        </div>
    </div>
@endsection