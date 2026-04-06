<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aspirasi</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100">

    <!-- NAVBAR -->
    <nav class="bg-blue-600 text-white shadow">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('input-aspirasi.index') }}" class="text-lg font-semibold">
                🧑‍🎓 Portal Siswa
            </a>

            <p class="text-sm">
                Halo, <span class="font-semibold">{{ Auth::user()->nama }}</span>
            </p>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="max-w-3xl mx-auto mt-10 px-4">

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            <!-- HEADER -->
            <div class="bg-blue-600 px-6 py-4">
                <h4 class="text-white font-semibold text-lg">
                    ➕ Tambah Aspirasi Baru
                </h4>
            </div>

            <!-- BODY -->
            <div class="p-6 space-y-5">

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                        <strong>Terjadi kesalahan!</strong>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('input-aspirasi.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Kategori -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>

                        <select name="id_category"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none @error('id_category') border-red-500 @enderror"
                            required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id_category }}"
                                    {{ old('id_category') == $cat->id_category ? 'selected' : '' }}>
                                    {{ $cat->ket_category }}
                                </option>
                            @endforeach
                        </select>

                        @error('id_category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">
                            Lokasi <span class="text-red-500">*</span>
                        </label>

                        <input type="text" name="lokasi" value="{{ old('lokasi') }}" maxlength="50"
                            placeholder="Contoh: Ruang Kelas 10A"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none @error('lokasi') border-red-500 @enderror"
                            required>

                        @error('lokasi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label class="block font-semibold text-gray-700 mb-2">
                            Keterangan <span class="text-red-500">*</span>
                        </label>

                        <textarea name="ket" rows="4" maxlength="50" placeholder="Jelaskan aspirasi Anda..."
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none @error('ket') border-red-500 @enderror"
                            required>{{ old('ket') }}</textarea>

                        @error('ket')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <p class="text-xs text-gray-400 mt-1">
                            Maksimal 50 karakter
                        </p>
                    </div>

                    <!-- Info -->
                    <div class="bg-blue-100 text-blue-700 px-4 py-3 rounded-lg text-sm">
                        <strong>📌 Catatan:</strong> NIS Anda
                        (<span class="font-mono">{{ Auth::user()->nis }}</span>)
                        akan otomatis tercatat.
                    </div>

                    <!-- BUTTON -->
                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium shadow transition">
                            💾 Kirim Aspirasi
                        </button>

                        <a href="{{ route('input-aspirasi.index') }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-5 py-2 rounded-lg font-medium transition">
                            ❌ Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>

</body>

</html>
