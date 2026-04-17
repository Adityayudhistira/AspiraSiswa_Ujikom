<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasi Siswa</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

    <nav class="bg-blue-600 text-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold"> Portal Siswa</h1>

            <div class="flex items-center gap-4">
                <p class="text-sm">
                    Halo, <span class="font-semibold">{{ Auth::user()->nama }}</span>
                </p>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        class="bg-white text-blue-600 px-3 py-1 rounded-lg text-sm font-medium hover:bg-gray-100 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 mt-8 space-y-6">

        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">
                📋 Semua Aspirasi Siswa
            </h2>

            <a href="{{ route('input-aspirasi.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                ➕ Tambah Aspirasi
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">

                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">NIS</th>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Lokasi</th>
                            <th class="px-4 py-3">Keterangan</th>
                            <th class="px-4 py-3">Gambar</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse ($query as $index => $item)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-4 py-3">{{ $index + 1 }}</td>

                                <td class="px-4 py-3 font-medium">
                                    {{ $item->nis }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $item->siswa->nama }}

                                    @if ($item->nis === Auth::user()->nis)
                                        <span
                                            class="ml-2 text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-md font-medium">
                                            Saya
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded-md text-xs">
                                        {{ $item->category->ket_category }}
                                    </span>
                                </td>

                                <td class="px-4 py-3">{{ $item->lokasi }}</td>

                                <td class="px-4 py-3">
                                    {{ Str::limit($item->ket, 30) }}
                                </td>

                                <td class="px-4 py-3">
                                    @if ($item->gambar)
                                        <img src="{{ $item->gambar_url }}"
                                            class="w-16 h-16 object-cover rounded-lg border cursor-pointer hover:scale-105 transition"
                                            onclick="openModal('{{ $item->gambar_url }}')">
                                    @else
                                        <span class="text-xs text-gray-400">Tidak ada</span>
                                    @endif
                                </td>

                                <td class="px-4 py-3">
                                    @if ($item->aspirasi)
                                        @php
                                            $status = $item->aspirasi->status;
                                            $color = match ($status) {
                                                'Menunggu' => 'bg-yellow-100 text-yellow-700',
                                                'Proses' => 'bg-blue-100 text-blue-700',
                                                'Selesai' => 'bg-green-100 text-green-700',
                                                default => 'bg-gray-100 text-gray-700',
                                            };
                                        @endphp

                                        <span class="px-2 py-1 text-xs rounded-md {{ $color }}">
                                            {{ $status }}
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs rounded-md bg-gray-100 text-gray-600">
                                            Belum Diproses
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ $item->created_at->format('d/m/Y') }}
                                </td>

                                <td class="px-4 py-3">
                                    <div class="flex gap-2">

                                        <a href="{{ route('input-aspirasi.show', $item->id_pelaporan) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs transition">
                                            Detail
                                        </a>

                                    </div>
                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-6 text-gray-500">
                                    Belum ada aspirasi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

        <div
            class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg text-sm flex items-start gap-2">

            <span>ℹ️</span>

            <div>
                <strong>Informasi:</strong>
                Setiap aspirasi yang sudah dikirim tidak dapat diubah.
                Silakan pastikan data yang dimasukkan sudah benar sebelum dikirim.
            </div>

        </div>

    </div>

</body>

</html>
