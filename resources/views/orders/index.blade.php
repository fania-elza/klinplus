@extends('layouts.app')

@section('title-content')
<h1>Order</h1>
@endsection

@section('content')
<div class="container mb-3">
    <div class="btn-petugas">
        <button class="btn btn-new" data-bs-toggle="modal" data-bs-target="#tambahOrderModal">
            Tambah Order Baru
        </button>
    </div>
</div>

<div class="container-table">
    <div class="table-wrapper">
        <table class="order-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Status</th>
                    <th>ID Order</th>
                    <th>Nama Pelanggan</th>
                    <th>Alamat</th>
                    <th>Gmaps</th>
                    <th>Tanggal Pembersihan</th>
                    <th>Waktu Pembersihan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->id_order }}</td>
                    <td>{{ $order->pelanggan->nama_pelanggan ?? '-' }}</td>
                    <td>{{ $order->pelanggan->alamat ?? '-' }}</td>
                    <td>
                        @if($order->pelanggan->gmaps ?? false)
                            <a href="{{ $order->pelanggan->gmaps }}" target="_blank">Lihat</a>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $order->tanggal_pembersihan }}</td>
                    <td>{{ $order->waktu_pembersihan }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('orders.show', $order->id_order) }}" class="btn btn-info btn-sm">
                                Detail
                            </a>
                            <form action="{{ route('orders.destroy', $order->id_order) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus order ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                            <form action="{{ route('orders.approve', $order->id_order) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">
                                    Setuju
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">Belum ada data order</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Tambah Order Modal -->
<div class="modal fade" id="tambahOrderModal" tabindex="-1" aria-labelledby="tambahOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header bg-white text-dark">
              <h5 class="modal-title" id="tambahOrderModalLabel">Tambah Order Baru</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="formTambahOrder" method="POST" action="{{ route('orders.store') }}">
              @csrf
              <div class="modal-body">
                <div class="mb-3">
                    <label for="id_pelanggan" class="form-label">Pilih Pelanggan</label>
                    <select class="form-select" id="id_pelanggan" name="id_pelanggan" required>
                        <option value="" selected disabled>-- Pilih Pelanggan --</option>
                        @foreach($pelanggans as $pelanggan)
                        <option 
                            value="{{ $pelanggan->id_pelanggan }}"
                            data-alamat="{{ $pelanggan->alamat }}"
                            data-gmaps="{{ $pelanggan->gmaps ?? '' }}">
                            {{ $pelanggan->nama_pelanggan }} | {{ $pelanggan->alamat }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="inputAlamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="inputAlamat" name="alamat" readonly>
                </div>
                
                <div class="mb-3">
                    <label for="inputGmaps" class="form-label">Gmaps</label>
                    <input type="text" class="form-control" id="inputGmaps" name="gmaps" readonly>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_pembersihan" class="form-label">Tanggal Pembersihan</label>
                        <input type="date" class="form-control" id="tanggal_pembersihan" name="tanggal_pembersihan" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="waktu_pembersihan" class="form-label">Waktu Pembersihan</label>
                        <input type="time" class="form-control" id="waktu_pembersihan" name="waktu_pembersihan" required>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn-back" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn-add">Tambahkan</button>
              </div>
          </form>
      </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Pastikan ID ini sesuai dengan select element Anda
    const pelangganSelect = document.getElementById('id_pelanggan');
    const alamatInput = document.getElementById('inputAlamat');
    const gmapsInput = document.getElementById('inputGmaps');

    // 2. Fungsi untuk mengisi alamat otomatis
    function isiAlamatOtomatis() {
        const selectedOption = pelangganSelect.options[pelangganSelect.selectedIndex];
        
        // Debugging: Lihat di console browser
        console.log('Data pelanggan:', {
            alamat: selectedOption.getAttribute('data-alamat'),
            gmaps: selectedOption.getAttribute('data-gmaps')
        });

        if (selectedOption.value) {
            alamatInput.value = selectedOption.getAttribute('data-alamat') || '';
            gmapsInput.value = selectedOption.getAttribute('data-gmaps') || '';
        }
    }

    // 3. Event listener untuk perubahan select
    pelangganSelect.addEventListener('change', isiAlamatOtomatis);

    // 4. Trigger saat modal dibuka (optional)
    const orderModal = document.getElementById('tambahOrderModal');
    if (orderModal) {
        orderModal.addEventListener('shown.bs.modal', function() {
            isiAlamatOtomatis();
        });
    }
});
</script>
@endpush


