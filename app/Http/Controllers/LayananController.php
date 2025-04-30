<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    // Menampilkan daftar layanan
    public function index()
    {
        $layanans = Layanan::orderBy('id_pricelist')->get();
        return view('layanan.index', compact('layanans'));
    }

    // Menyimpan layanan baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'id_pricelist' => 'required|string|max:50|unique:layanans,id_pricelist',
            'nama_layanan' => 'required|string|max:255',
            'durasi' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);
        
        // Membersihkan format harga jika ada karakter selain angka
        $validated['harga'] = (int) preg_replace('/[^0-9]/', '', $validated['harga']);
        $validated['id_pricelist'] = trim($validated['id_pricelist']);
        
        // Menyimpan data layanan
        Layanan::create($validated);

        // Redirect ke halaman daftar layanan dengan pesan sukses
        return redirect()->route('layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    // Memperbarui layanan yang ada
    public function update(Request $request, Layanan $layanan)
    {
        // Validasi input
        $validated = $request->validate([
            'id_pricelist' => 'required|string|max:50|unique:layanans,id_pricelist,' . $layanan->id, // Update hanya untuk id layanan yang berbeda
            'nama_layanan' => 'required|string|max:255',
            'durasi' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);
        
        // Membersihkan format harga jika ada karakter selain angka
        $validated['harga'] = (int) preg_replace('/[^0-9]/', '', $validated['harga']);
        
        // Memperbarui data layanan
        $layanan->update($validated);
        
        // Redirect ke halaman daftar layanan dengan pesan sukses
        return redirect()->route('layanan.index')
            ->with('success', 'Layanan berhasil diperbarui!');
    }

    // Menghapus layanan
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('layanan.index')
            ->with('success', 'Layanan berhasil dihapus!');
    }
}


