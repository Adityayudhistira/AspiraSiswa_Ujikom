<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InputAspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputAspirasiController extends Controller
{
    // TAMPILKAN SEMUA DATA
    public function index(Request $request)
    {

        $request->validate([
            'tanggal_awal' => 'nullable|date',
            'tanggal_akhir' => 'nullable|date|after_or_equal:tanggal_awal',
        ]);

        $data = InputAspirasi::with(['siswa', 'category', 'aspirasi'])
            ->orderBy('created_at', 'desc');

        if (Auth::guard('admin')->check()) {

            if ($request->filled('tanggal_awal') && $request->filled('tanggal_akhir')) {
                $data->whereBetween('created_at', [
                    $request->tanggal_awal . ' 00:00:00',
                    $request->tanggal_akhir . ' 23:59:59'
                ]);
            } elseif ($request->filled('tanggal_awal')) {
                $data->whereDate('created_at', $request->tanggal_awal);
            }

            if ($request->filled('nis')) {
                $data->where('nis', $request->nis);
            }

            if ($request->filled('id_category')) {
                $data->where('id_category', $request->id_category);
            }

            $query = $data->get();

            $stats = [
                'total' => $query->count(),
                'menunggu' => $query->where('aspirasi.status', 'Menunggu')->count(),
                'proses' => $query->where('aspirasi.status', 'Proses')->count(),
                'selesai' => $query->where('aspirasi.status', 'Selesai')->count(),
            ];

            $categories = \App\Models\Category::all();
            $siswas = \App\Models\Siswa::all();

            // Admin: tampilkan view admin
            return view('admin.aspirasi.index', compact('query', 'categories', 'siswas', 'stats'));
        }

        // buat siswa
        $query = $data->get();
        return view('input-aspirasi.index', compact('query'));
    }

    // FORM TAMBAH DATA
    public function create()
    {
        $categories = Category::all();
        return view('input-aspirasi.create', compact('categories'));
    }

    // SIMPAN DATA
    public function store(Request $request)
    {
        // jadi intinya fungsi exist itu ngevalidasi bahwa nilai nis yg digunakan di tabel FK ada di tbel PK
        $request->validate([
            'id_category' => 'required|exists:category,id_category',
            'lokasi' => 'required|string|max:50',
            'ket' => 'required|string|max:50',
        ]);

        // Buat aspirasi baru di tabel input_aspirasi
        $inputAspirasi = InputAspirasi::create([
            'nis' => Auth::guard('siswa')->user()->nis, // NIS otomatis dari yang login
            'id_category' => $request->id_category,
            'lokasi' => $request->lokasi,
            'ket' => $request->ket,
        ]);

        // biar di tabel aspirasi dgn status default
        $inputAspirasi->aspirasi()->create([
            'id_pelaporan' => $inputAspirasi->id_pelaporan,
            'id_category' => $request->id_category, // WAJIB ADA
            'status' => 'Menunggu',
            'feedback' => null,
        ]);

        return redirect()->route('input-aspirasi.index')
            ->with('success', 'Aspirasi berhasil dikirim dan menunggu review admin!');
    }

    // DETAIL DATA
    public function show(InputAspirasi $inputAspirasi)
    {
        $inputAspirasi->load(['siswa', 'category', 'aspirasi']);

        // yg didalem compact didapet dari ($inputAspirasi)
        return view('input-aspirasi.show', compact('inputAspirasi'));
    }


    // FORM EDIT
    public function edit(InputAspirasi $inputAspirasi)
    {
        if (Auth::guard('admin')->check()) {
            // Admin bisa edit semua (tapi pakai editStatus)
            return redirect()->route('admin.aspirasi.editStatus', $inputAspirasi->id_pelaporan);
        }
    }


    // UPDATE DATA
    public function update(Request $request, InputAspirasi $inputAspirasi)
    {

        return redirect()->route('admin.aspirasi.editStatus', $inputAspirasi->id_pelaporan);
    }


    // HAPUS DATA
    public function destroy(InputAspirasi $inputAspirasi)
    {
        // Jika siswa
        if (Auth::guard('siswa')->check()) {

            if ($inputAspirasi->nis !== Auth::guard('siswa')->user()->nis) {
                abort(403, 'Anda tidak memiliki akses untuk hapus aspirasi ini.');
            }

            $inputAspirasi->delete();

            return redirect()->route('input-aspirasi.index')
                ->with('success', 'Data berhasil dihapus');
        }

        // Jika admin
        if (Auth::guard('admin')->check()) {

            $inputAspirasi->delete();

            return redirect()->route('admin.aspirasi.index')
                ->with('success', 'Data berhasil dihapus');
        }

        abort(403);
    }

    public function editStatus($id)
    {
        $inputAspirasi = InputAspirasi::with(['siswa', 'category', 'aspirasi'])
            ->findOrFail($id);

        $statusOptions = ['Menunggu', 'Proses', 'Selesai'];

        return view('admin.aspirasi.edit-status', compact('inputAspirasi', 'statusOptions'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'nullable|string|max:255',
        ]);

        $inputAspirasi = InputAspirasi::findOrFail($id);

        // Update atau buat record di tabel aspirasi
        $inputAspirasi->aspirasi()->updateOrCreate(
            ['id_pelaporan' => $inputAspirasi->id_pelaporan],
            [
                'status' => $request->status,
                'feedback' => $request->feedback,
            ]
        );

        return redirect()->route('admin.aspirasi.index')
            ->with('success', 'Status dan feedback berhasil diupdate!');
    }
}
