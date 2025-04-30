<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelanggans = Pelanggan::orderBy('created_at', 'asc')->paginate(10);
        return view('pelanggan.index', compact('pelanggans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.create', [
            'id_pelanggan' => $this->generatePelangganId()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi lebih eksplisit
    $validator = Validator::make($request->all(), [
        'nama_pelanggan' => 'required|min:3|max:100',
        'nomor_telepon' => [
            'required',
            'min:10',
            'max:15',
            'regex:/^[0-9]+$/',
            'unique:pelanggans,nomor_telepon'
        ],
        'email' => [
            'nullable',
            'email',
            'max:100',
            'unique:pelanggans,email'
        ],
        'alamat' => 'nullable|string|max:255',
        'gmaps' => 'nullable|url|max:500'
    ], [
        'nomor_telepon.unique' => 'Nomor telepon sudah terdaftar',
        'email.unique' => 'Email sudah terdaftar',
        'nomor_telepon.regex' => 'Hanya angka yang diperbolehkan'
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Validasi gagal: ' . $validator->errors()->first());
    }

    try {
        $validated = $validator->validated();
        $validated['id_pelanggan'] = $this->generatePelangganId();
        
        Pelanggan::create($validated);
        
        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan');
    } catch (\Exception $e) {
        Log::error('Error creating pelanggan: ' . $e->getMessage());
        return back()->withInput()
            ->with('error', 'Gagal menambahkan pelanggan. Silakan coba lagi.');
    }
}

    /**
 * Generate unique Pelanggan ID in format CSYYMMNNN
 */
protected function generatePelangganId(): string
{
    $now = Carbon::now();
    $prefix = 'CS' . $now->format('ym'); // Tahun 2 digit dan Bulan
    
    // Cari ID terakhir dengan prefix bulan ini
    $lastPelanggan = Pelanggan::where('id_pelanggan', 'like', $prefix.'%')
        ->orderBy('id_pelanggan', 'desc')
        ->first();

    // Jika ada, ambil nomor urut terakhir + 1
    if ($lastPelanggan) {
        $lastSequence = (int) substr($lastPelanggan->id_pelanggan, -3);
        $sequence = $lastSequence + 1;
    } else {
        // Jika tidak ada, mulai dari 001
        $sequence = 1;
    }

    // Format nomor urut 3 digit
    $sequenceFormatted = str_pad($sequence, 3, '0', STR_PAD_LEFT);
    
    return $prefix . $sequenceFormatted;
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            return view('pelanggan.show', compact('pelanggan'));
        } catch (\Exception $e) {
            Log::error('Error showing pelanggan: ' . $e->getMessage());
            return back()->with('error', 'Pelanggan tidak ditemukan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            return view('pelanggan.edit', compact('pelanggan'));
        } catch (\Exception $e) {
            Log::error('Error editing pelanggan: ' . $e->getMessage());
            return back()->with('error', 'Pelanggan tidak ditemukan.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_pelanggan' => 'required|min:3|max:100',
            'nomor_telepon'  => [
                'required',
                'min:10',
                'max:15',
                'regex:/^[0-9]+$/',
                Rule::unique('pelanggans')->ignore($pelanggan->id)
            ],
            'email' => [
                'nullable',
                'email',
                'max:100',
                Rule::unique('pelanggans')->ignore($pelanggan->id)
            ],
            'alamat' => 'nullable|string|max:255',
            'gmaps'  => 'nullable|url|max:255'
        ], [
            'nomor_telepon.unique' => 'Nomor telepon ini sudah terdaftar',
            'email.unique' => 'Email ini sudah terdaftar',
            'nomor_telepon.regex' => 'Nomor telepon hanya boleh berisi angka'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $pelanggan->update($validator->validated());

            return redirect()->route('pelanggan.index')
                ->with('success', 'Data pelanggan berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error updating pelanggan: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Gagal memperbarui data pelanggan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $pelanggan = Pelanggan::findOrFail($id);
            $pelanggan->delete();

            return redirect()->route('pelanggan.index')
                ->with('success', 'Pelanggan berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Error deleting pelanggan: ' . $e->getMessage());
            return back()->with('error', 'Gagal menghapus pelanggan.');
        }
    }
}

