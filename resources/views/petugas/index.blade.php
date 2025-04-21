@extends('layouts.app')

@section('title-content')
<h1>Petugas</h1>
@endsection

@section('content')
    <div class="container">
        <div class="btn-petugas">
            <a href="#" class="btn btn-primary">
                Tambah Petugas Baru
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
                        <th>Action</th>
                    </tr>
                </thread>
            </table>
        </div>
    </div>

@endsection