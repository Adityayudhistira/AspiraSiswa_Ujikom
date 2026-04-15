@extends('admin.layout.sidebar')

@section('content')

    <div class="min-h-screen bg-linear-to-br from-slate-100 to-slate-200 py-10 px-6">

        <div class="max-w-3xl mx-auto space-y-6">

            <a href="{{ route('admin.siswa.index') }}"
                class="inline-flex items-center gap-2 bg-white text-slate-700 px-4 py-2 rounded-xl text-sm font-medium shadow hover:bg-gray-100 hover:shadow-md transition">
                ← Kembali ke Siswa
            </a>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <div class="bg-blue-500 px-8 py-5">
                    <h4 class="text-xl font-semibold text-white">
                        ➕ Tambah Akun Siswa Baru
                    </h4>
                </div>

                <div class="p-8 space-y-6">

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl">
                            <strong>Terjadi kesalahan!</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                NIS <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="nis" value="{{ old('nis') }}" maxlength="20" required
                                placeholder="Contoh: 12345678"
                                class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition @error('nis') border-red-500 @enderror">

                            @error('nis')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="nama" value="{{ old('nama') }}" maxlength="70" required
                                placeholder="Contoh: Aditya"
                                class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition @error('nama') border-red-500 @enderror">

                            @error('nama')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Kelas <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="kelas" value="{{ old('kelas') }}" maxlength="10" required
                                placeholder="Contoh: 12PPLG1"
                                class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition @error('kelas') border-red-500 @enderror">

                            @error('kelas')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Password <span class="text-red-500">*</span>
                            </label>

                            <input type="password" name="password" required placeholder="Minimal 6 karakter"
                                class="w-full px-5 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none transition @error('password') border-red-500 @enderror">

                            @error('password')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3 pt-4">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold shadow hover:shadow-lg transition">
                                💾 Simpan
                            </button>

                            <a href="{{ route('admin.siswa.index') }}"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-xl font-semibold transition">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

@endsection
