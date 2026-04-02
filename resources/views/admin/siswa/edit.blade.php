@extends('admin.layout.sidebar')

@section('content')

    <div class="min-h-screen bg-linear-to-br from-slate-100 to-slate-200 py-10 px-6">

        <div class="max-w-3xl mx-auto space-y-6">

            <!-- Back Button -->
            <a href="{{ route('admin.siswa.index') }}"
                class="inline-flex items-center gap-2 bg-white text-slate-700 px-4 py-2 rounded-xl text-sm font-medium shadow hover:shadow-md hover:bg-gray-100 transition">
                ← Kembali ke Siswa
            </a>

            <!-- Card Edit -->
            <div class="bg-white shadow-xl rounded-3xl overflow-hidden">

                <div class="bg-blue-500 px-8 py-5">
                    <h4 class="text-xl font-semibold text-white">
                        ✏️ Edit Akun Siswa
                    </h4>
                </div>

                <div class="p-8 space-y-6">

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">
                            <strong>Terjadi kesalahan!</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.siswa.update', $siswa->nis) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- NIS -->
                        <div>
                            <label class="block font-semibold mb-2 text-gray-700">
                                NIS <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="nis" value="{{ old('nis', $siswa->nis) }}" maxlength="20"
                                required
                                class="w-full px-5 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition @error('nis') border-red-500 @enderror">

                            @error('nis')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama -->
                        <div>
                            <label class="block font-semibold mb-2 text-gray-700">
                                Nama <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}" maxlength="70"
                                required
                                class="w-full px-5 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition @error('nama') border-red-500 @enderror">

                            @error('nama')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kelas -->
                        <div>
                            <label class="block font-semibold mb-2 text-gray-700">
                                Kelas <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="kelas" value="{{ old('kelas', $siswa->kelas) }}" maxlength="10"
                                required
                                class="w-full px-5 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition @error('kelas') border-red-500 @enderror">

                            @error('kelas')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password (optional) -->
                        <div>
                            <label class="block font-semibold mb-2 text-gray-700">
                                Password (Opsional)
                            </label>

                            <input type="password" name="password"
                                placeholder="Kosongkan jika tidak ingin mengubah password"
                                class="w-full px-5 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition @error('password') border-red-500 @enderror">

                            @error('password')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror

                            <p class="text-gray-500 text-xs mt-2">
                                Minimal 6 karakter (isi jika ingin mengganti password)
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4 pt-2">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold shadow hover:shadow-lg transition">
                                💾 Update
                            </button>

                            <a href="{{ route('admin.siswa.index') }}"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-xl font-semibold transition">
                                ❌ Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
