<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\InputAspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InputAspirasiController extends Controller
{
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

            if ($request->filled('status')) {
                $data->whereHas('aspirasi', function ($q) use ($request) {
                    $q->where('status', $request->status);
                });
            }

            $query = $data->get();

            $stats = [
                'total' => $query->count(),
                'menunggu' => $query->filter(fn($item) => optional($item->aspirasi)->status == 'Menunggu')->count(),
                'proses' => $query->filter(fn($item) => optional($item->aspirasi)->status == 'Proses')->count(),
                'selesai' => $query->filter(fn($item) => optional($item->aspirasi)->status == 'Selesai')->count(),
            ];

            $categories = \App\Models\Category::all();
            $siswas = \App\Models\Siswa::all();

            return view('admin.aspirasi.index', compact('query', 'categories', 'siswas', 'stats'));
        }

        $query = $data->get();
        return view('input-aspirasi.index', compact('query'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('input-aspirasi.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_category' => 'required|exists:category,id_category',
            'lokasi' => 'required|string|max:50',
            'ket' => 'required|string|max:50',
        ]);

        $inputAspirasi = InputAspirasi::create([
            'nis' => Auth::guard('siswa')->user()->nis,
            'id_category' => $request->id_category,
            'lokasi' => $request->lokasi,
            'ket' => $request->ket,
        ]);

        $inputAspirasi->aspirasi()->create([
            'id_pelaporan' => $inputAspirasi->id_pelaporan,
            'id_category' => $request->id_category,
            'status' => 'Menunggu',
            'feedback' => null,
        ]);

        return redirect()->route('input-aspirasi.index')
            ->with('success', 'Aspirasi berhasil dikirim dan menunggu review admin!');
    }

    public function show(InputAspirasi $inputAspirasi)
    {
        $inputAspirasi->load(['siswa', 'category', 'aspirasi']);

        return view('input-aspirasi.show', compact('inputAspirasi'));
    }


    public function edit(InputAspirasi $inputAspirasi)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.aspirasi.editStatus', $inputAspirasi->id_pelaporan);
        }
    }


    public function update(Request $request, InputAspirasi $inputAspirasi)
    {

        return redirect()->route('admin.aspirasi.editStatus', $inputAspirasi->id_pelaporan);
    }


    public function destroy(InputAspirasi $inputAspirasi)
    {
        if (Auth::guard('siswa')->check()) {

            if ($inputAspirasi->nis !== Auth::guard('siswa')->user()->nis) {
                abort(403, 'Anda tidak memiliki akses untuk hapus aspirasi ini.');
            }

            $inputAspirasi->delete();

            return redirect()->route('input-aspirasi.index')
                ->with('success', 'Data berhasil dihapus');
        }

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
