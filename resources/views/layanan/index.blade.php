@extends('layouts.app')

@section('title-content')
<h1>Layanan</h1>
@endsection

@section('content')
<div class="container">
    <div class="btn-layanan">
        <button type="button" class="btn btn-new" data-bs-toggle="modal" data-bs-target="#tambahLayananModal">
            Tambah Layanan
        </button>
    </div>
</div>
<div class="container-table">
    <div class="table-wrapper">
        <table class="staf-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Id Pricelist</th>
                    <th>Nama Layanan</th>
                    <th>Durasi</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($layanans as $layanan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $layanan->id }}</td>
                    <td>{{ $layanan->nama_layanan }}</td>
                    <td>{{ $layanan->durasi }} menit</td>
                    <td>Rp {{ number_format($layanan->harga, 0, ',', '.') }}</td>
                    <td>{{ $layanan->deskripsi }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="$" class="edit-button" title="Edit">
                                Edit
                            </a>
                            <form action="#" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                                    Hapus
                                </button>
                                <i class="fas fa-trash"></i>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Tambah Layanan Modal -->
<div class="modal fade" id="tambahLayananModal" tabindex="-1" aria-labelledby="tambahLayananModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header bg-white text-dark">
                <h5 class="modal-title" id="tambahLayananModalLabel">Tambah Layanan Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formTambahLayanan" method="POST" action="{{ route('layanan.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id_pricelist" class="form-label">ID Pricelist</label>
                        <input type="text" class="form-control" id="id_pricelist" name="id_pricelist" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_layanan" class="form-label">Nama Layanan</label>
                        <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" required>
                    </div>
                    <div class="mb-3">
                        <label for="durasi" class="form-label">Durasi (Menit)</label>
                        <input type="number" class="form-control" id="durasi" name="durasi" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-back" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-add">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Format harga input
    $('#harga').on('input', function() {
        // Remove non-numeric characters
        let value = $(this).val().replace(/\D/g, '');
        // Format with thousand separators
        $(this).val(formatNumber(value));
    });

    // Helper function to format number
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    }
});
</script>
@endpush

