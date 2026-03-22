@extends('admin.layout.sidebar')

@section('content')
    <a href="{{ route('admin.aspirasi.index') }}"
        class="inline-flex items-center gap-2 bg-white text-slate-700 px-4 py-2 rounded-xl text-sm font-medium shadow hover:shadow-md hover:bg-gray-100 transition">
        ← Kembali ke Aspirasi
    </a>

    <div class="max-w-4xl mx-auto mt-8 px-6">
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

            <!-- Header -->
            <div class="bg-blue-500 text-white px-6 py-4">
                <h2 class="text-lg font-semibold">✏️ Edit Status & Feedback Aspirasi</h2>
            </div>

            <div class="p-6">

                <!-- Informasi Aspirasi -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 mb-6">
                    <h3 class="font-semibold text-blue-800 mb-3">📌 Informasi Aspirasi</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="font-medium text-gray-600">Siswa</p>
                            <p class="text-gray-900">
                                {{ $inputAspirasi->siswa->nama }} ({{ $inputAspirasi->nis }})
                            </p>
                        </div>

                        <div>
                            <p class="font-medium text-gray-600">Kelas</p>
                            <p class="text-gray-900">
                                {{ $inputAspirasi->siswa->kelas }}
                            </p>
                        </div>

                        <div>
                            <p class="font-medium text-gray-600">Kategori</p>
                            <p class="text-gray-900">
                                {{ $inputAspirasi->category->ket_category }}
                            </p>
                        </div>

                        <div>
                            <p class="font-medium text-gray-600">Lokasi</p>
                            <p class="text-gray-900">
                                {{ $inputAspirasi->lokasi }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="font-medium text-gray-600">Keterangan</p>
                            <p class="text-gray-900">
                                {{ $inputAspirasi->ket }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('admin.aspirasi.updateStatus', $inputAspirasi->id_pelaporan) }}" method="POST"
                    class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>

                        <select name="status"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-slate-500 focus:outline-none @error('status') border-red-500 @enderror"
                            required>
                            @foreach ($statusOptions as $option)
                                <option value="{{ $option }}"
                                    {{ $inputAspirasi->aspirasi && $inputAspirasi->aspirasi->status == $option ? 'selected' : '' }}>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>

                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Feedback -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Feedback
                        </label>

                        <textarea name="feedback" rows="4" maxlength="255" placeholder="Berikan feedback untuk siswa... (opsional)"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-slate-500 focus:outline-none @error('feedback') border-red-500 @enderror">{{ $inputAspirasi->aspirasi->feedback ?? '' }}</textarea>

                        @error('feedback')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <p class="text-gray-400 text-xs mt-1">Maksimal 255 karakter</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3">
                        <button type="submit"
                            class="bg-blue-500 text-white px-5 py-2 rounded-lg font-medium hover:bg-slate-900 transition">
                            💾 Update
                        </button>

                        <a href="{{ route('admin.aspirasi.index') }}"
                            class="bg-gray-200 text-white-700 px-5 py-2 rounded-lg font-medium hover:bg-gray-300 transition">
                            ❌ Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
