@extends('admin.layout.sidebar')

@section('content')
    <div class="space-y-6">

        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold">
                📂 Kelola Kategori Aspirasi
            </h2>

            <a href="{{ route('admin.category.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                ➕ Tambah Kategori
            </a>
        </div>


        @if (session('success'))
            <div class="bg-green-100 border border-blue-300 text-blue-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif


        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left">

                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="px-6 py-3 w-16">No</th>
                            <th class="px-6 py-3">Nama Kategori</th>
                            <th class="px-6 py-3">Tanggal Dibuat</th>
                            <th class="px-6 py-3 w-48">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @forelse ($categories as $index => $category)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs">
                                        {{ $category->ket_category }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    @if ($category->created_at)
                                        {{ $category->created_at->format('d F Y') }}
                                    @else
                                        <span class="italic text-gray-400">-</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex gap-2">

                                        <a href="{{ route('admin.category.edit', $category->id_category) }}"
                                            class="flex items-center gap-1 bg-yellow-50 text-yellow-600 px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-yellow-100 transition">

                                            <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.category.destroy', $category->id_category) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin hapus kategori ini?')">
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
                                <td colspan="4" class="text-center py-6 text-gray-500">
                                    Belum ada kategori
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </div>
@endsection
