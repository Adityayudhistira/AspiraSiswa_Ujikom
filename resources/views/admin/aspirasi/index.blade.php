@extends('admin.layout.sidebar')

@section('content')
    <div class="p-6">

        <div>
            <h2 class="text-2xl font-semibold text-gray-800">
                Kelola Semua Aspirasi
            </h2>
            <p class="text-sm text-gray-500 mb-3">
                Monitoring dan manajemen seluruh data aspirasi siswa
            </p>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div class="bg-white p-5 rounded-2xl border shadow-sm">
                <p class="text-sm text-gray-500">Total Aspirasi</p>
                <h2 class="text-2xl font-bold text-blue-600 mt-1">
                    {{ $stats['total'] }}
                </h2>
            </div>

            <div class="bg-white p-5 rounded-2xl border shadow-sm">
                <p class="text-sm text-gray-500">Menunggu</p>
                <h2 class="text-2xl font-bold text-yellow-500 mt-1">
                    {{ $stats['menunggu'] }}
                </h2>
            </div>

            <div class="bg-white p-5 rounded-2xl border shadow-sm">
                <p class="text-sm text-gray-500">Proses</p>
                <h2 class="text-2xl font-bold text-blue-500 mt-1">
                    {{ $stats['proses'] }}
                </h2>
            </div>

            <div class="bg-white p-5 rounded-2xl border shadow-sm">
                <p class="text-sm text-gray-500">Selesai</p>
                <h2 class="text-2xl font-bold text-green-500 mt-1">
                    {{ $stats['selesai'] }}
                </h2>
            </div>

        </div>

        <div class="bg-white shadow rounded-2xl mb-6 mt-6">
            <div class="bg-blue-500 text-white px-6 py-3 rounded-t-2xl font-semibold">
                🔍 Filter Aspirasi
            </div>

            <form method="GET" action="{{ route('admin.aspirasi.index') }}" class="p-6 grid md:grid-cols-3 gap-4">

                <div>
                    <label class="text-sm font-medium">📅 Dari Tanggal</label>
                    <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}"
                        class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="text-sm font-medium">📅 Sampai Tanggal</label>
                    <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                        class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-400">
                </div>

                <div>
                    <label class="text-sm font-medium">👤 Siswa</label>
                    <select name="nis" class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-400">
                        <option value="">Semua Siswa</option>
                        @foreach ($siswas as $siswa)
                            <option value="{{ $siswa->nis }}" {{ request('nis') == $siswa->nis ? 'selected' : '' }}>
                                {{ $siswa->nama }} ({{ $siswa->nis }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium">📂 Kategori</label>
                    <select name="id_category"
                        class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-400">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id_category }}"
                                {{ request('id_category') == $cat->id_category ? 'selected' : '' }}>
                                {{ $cat->ket_category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium">📊 Status</label>
                    <select name="status" class="w-full border rounded-lg px-3 py-2 mt-1 focus:ring-2 focus:ring-blue-400">
                        <option value="">Semua Status</option>
                        <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">

                    <button type="submit"
                        class="flex items-center gap-2 bg-blue-50 text-blue-600 px-4 py-2 rounded-lg text-sm font-medium border border-blue-200 hover:bg-blue-100 transition">

                        <i data-lucide="search" class="w-4 h-4"></i>
                        Filter
                    </button>

                    <a href="{{ route('admin.aspirasi.index') }}"
                        class="flex items-center gap-2 bg-gray-50 text-gray-600 px-4 py-2 rounded-lg text-sm font-medium border border-gray-200 hover:bg-gray-100 transition">

                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                        Reset
                    </a>

                </div>

            </form>
        </div>

        <div class="bg-white shadow rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">

                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">NIS</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Kelas</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Lokasi</th>
                            <th class="px-4 py-3">Keterangan</th>
                            <th class="px-4 py-3">Gambar</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse ($query as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">{{ $item->created_at->format('d/m/Y') }}</td>
                                <td class="px-4 py-3">{{ $item->nis }}</td>
                                <td class="px-4 py-3">{{ $item->siswa->nama }}</td>
                                <td class="px-4 py-3">{{ $item->siswa->kelas }}</td>

                                <td class="px-4 py-3">
                                    <span class="bg-gray-200 px-2 py-1 rounded text-xs">
                                        {{ $item->category->ket_category }}
                                    </span>
                                </td>

                                <td class="px-4 py-3">{{ Str::limit($item->lokasi, 15) }}</td>
                                <td class="px-4 py-3">{{ Str::limit($item->ket, 30) }}</td>
                                <td class="px-4 py-3">
                                    @if ($item->gambar)
                                        <img src="{{ $item->gambar_url }}"
                                            class="w-14 h-14 object-cover rounded-lg border cursor-pointer hover:scale-105 transition"
                                            onclick="openModal('{{ $item->gambar_url }}')">
                                    @else
                                        <span class="text-xs text-gray-400">-</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    @if ($item->aspirasi)
                                        @php
                                            $status = $item->aspirasi->status;
                                            $color = match ($status) {
                                                'Menunggu' => 'bg-yellow-400',
                                                'Proses' => 'bg-sky-500 text-white',
                                                'Selesai' => 'bg-green-500 text-white',
                                                default => 'bg-gray-400',
                                            };
                                        @endphp
                                        <span class="{{ $color }} px-2 py-1 rounded text-xs">
                                            {{ $status }}
                                        </span>
                                    @else
                                        <span class="bg-gray-300 px-2 py-1 rounded text-xs">
                                            Belum Diproses
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">

                                        <a href="{{ route('admin.aspirasi.editStatus', $item->id_pelaporan) }}"
                                            class="flex items-center gap-1 bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-yellow-100 transition">

                                            <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.aspirasi.destroy', $item->id_pelaporan) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="flex items-center gap-1 bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-red-100 transition">

                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center py-6 text-gray-500">
                                    Tidak ada data aspirasi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            @if ($query->count() > 0)
                <div class="p-4 bg-blue-50 text-blue-700 text-sm">
                    📊 Total hasil filter: <strong>{{ $query->count() }}</strong>
                </div>
            @endif
        </div>

    </div>
@endsection
