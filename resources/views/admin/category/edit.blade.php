@extends('admin.layout.sidebar')

@section('content')

    <div class="min-h-screen bg-linear-to-br from-slate-100 to-slate-200 py-10 px-6">

        <div class="max-w-3xl mx-auto space-y-6">

            <!-- Back Button -->
            <a href="{{ route('admin.category.index') }}"
                class="inline-flex items-center gap-2 bg-white text-slate-700 px-4 py-2 rounded-xl text-sm font-medium shadow hover:shadow-md hover:bg-gray-100 transition">
                ← Kembali ke Kategori
            </a>

            <!-- Card Edit -->
            <div class="bg-white shadow-xl rounded-3xl overflow-hidden">

                <div class="bg-blue-500 px-8 py-5">
                    <h4 class="text-xl font-semibold text-gray-800">
                        ✏️ Edit Kategori
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

                    <form action="{{ route('admin.category.update', $category->id_category) }}" method="POST"
                        class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block font-semibold mb-2 text-gray-700">
                                Nama Kategori <span class="text-red-500">*</span>
                            </label>

                            <input type="text" name="ket_category"
                                value="{{ old('ket_category', $category->ket_category) }}" maxlength="30" required autofocus
                                class="w-full px-5 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 transition @error('ket_category') border-red-500 @enderror">

                            @error('ket_category')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror

                            <p class="text-gray-500 text-xs mt-2">
                                Maksimal 30 karakter
                            </p>
                        </div>

                        <div class="flex gap-4 pt-2">
                            <button type="submit"
                                class="bg-blue-400 hover:bg-blue-500 text-white-800 px-6 py-3 rounded-xl font-semibold shadow hover:shadow-lg transition">
                                💾 Update Kategori
                            </button>

                            <a href="{{ route('admin.category.index') }}"
                                class="bg-gray-300 hover:bg-gray-400 text-white-800 px-6 py-3 rounded-xl font-semibold transition">
                                ❌ Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
