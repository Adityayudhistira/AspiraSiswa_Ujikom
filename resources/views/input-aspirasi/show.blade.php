<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aspirasi</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

    <nav class="bg-blue-600 text-white shadow">
        <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('input-aspirasi.index') }}" class="text-lg font-semibold">
                Portal Siswa
            </a>

            <p class="text-sm">
                Halo, <span class="font-semibold">{{ Auth::user()->nama }}</span>
            </p>
        </div>
    </nav>

    <div class="max-w-3xl mx-auto mt-10 px-4">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <div class="bg-blue-600 px-6 py-4">
                <h4 class="text-white font-semibold text-lg">
                    📄 Detail Aspirasi
                </h4>
            </div>

            <div class="p-6 space-y-6">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">

                    <div>
                        <p class="text-gray-500">NIS</p>
                        <p class="font-semibold">{{ $inputAspirasi->nis }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Nama Siswa</p>
                        <p class="font-semibold">{{ $inputAspirasi->siswa->nama }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Kelas</p>
                        <p class="font-semibold">{{ $inputAspirasi->siswa->kelas }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Kategori</p>
                        <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded-md text-xs">
                            {{ $inputAspirasi->category->ket_category }}
                        </span>
                    </div>

                    <div>
                        <p class="text-gray-500">Lokasi</p>
                        <p class="font-semibold">{{ $inputAspirasi->lokasi }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Tanggal</p>
                        <p class="font-semibold">
                            {{ $inputAspirasi->created_at->format('d F Y, H:i') }}
                        </p>
                    </div>

                </div>

                <div>
                    <p class="text-gray-500 mb-1">Keterangan</p>
                    <div class="bg-gray-100 p-4 rounded-lg text-sm">
                        {{ $inputAspirasi->ket }}
                    </div>
                </div>

                <div>
                    <p class="text-gray-500 mb-2">Status</p>

                    @if ($inputAspirasi->aspirasi)
                        @php
                            $status = $inputAspirasi->aspirasi->status;
                            $color = match ($status) {
                                'Menunggu' => 'bg-yellow-100 text-yellow-700',
                                'Proses' => 'bg-blue-100 text-blue-700',
                                'Selesai' => 'bg-green-100 text-green-700',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        @endphp

                        <span class="px-3 py-1 rounded-md text-sm font-medium {{ $color }}">
                            {{ $status }}
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-md text-sm bg-gray-100 text-gray-600">
                            Belum Diproses
                        </span>
                    @endif
                </div>

                <div>
                    <p class="text-gray-500 mb-2">Feedback Admin</p>

                    @if ($inputAspirasi->aspirasi && $inputAspirasi->aspirasi->feedback)
                        <div class="bg-blue-100 text-blue-700 px-4 py-3 rounded-lg text-sm">
                            {{ $inputAspirasi->aspirasi->feedback }}
                        </div>
                    @else
                        <p class="text-gray-400 text-sm italic">
                            Belum ada feedback dari admin
                        </p>
                    @endif
                </div>

                <div class="flex gap-3 pt-4">

                    <a href="{{ route('input-aspirasi.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg text-sm transition">
                        ← Kembali
                    </a>

                    @if ($inputAspirasi->nis === Auth::user()->nis)
                        <form action="{{ route('input-aspirasi.destroy', $inputAspirasi->id_pelaporan) }}"
                            method="POST" onsubmit="return confirm('Yakin ingin hapus aspirasi ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                                🗑️ Hapus
                            </button>
                        </form>
                    @endif

                </div>

            </div>
        </div>

    </div>

</body>

</html>
