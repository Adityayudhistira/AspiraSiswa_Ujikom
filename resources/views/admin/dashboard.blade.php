@extends('admin.layout.sidebar')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="space-y-6">

        @if (session('success'))
            <div
                class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg flex justify-between items-center">
                <div>
                    ✔ {{ session('success') }}
                </div>
            </div>
        @endif


        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold mb-4">📊 Statistik Aspirasi</h3>

            <div class="w-64 mx-auto">
                <canvas id="chartAspirasi"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Total Pengaduan</p>
                        <h2 class="text-3xl font-bold text-blue-600 mt-2">
                            {{ $totalPengaduan }}
                        </h2>
                    </div>
                    <div class="text-blue-600 text-4xl">
                        📋
                    </div>
                </div>

                <a href="{{ route('admin.aspirasi.index') }}"
                    class="mt-4 block text-center border border-blue-600 text-blue-600 py-2 rounded-lg hover:bg-blue-600 hover:text-white transition">
                    Lihat Detail →
                </a>
            </div>


            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Pengaduan Proses</p>
                        <h2 class="text-3xl font-bold text-yellow-500 mt-2">
                            {{ $pengaduanProses }}
                        </h2>
                    </div>
                    <div class="text-yellow-500 text-4xl">
                        ⏳
                    </div>
                </div>

                <a href="{{ route('admin.aspirasi.index', ['status' => 'Proses']) }}"
                    class="mt-4 block text-center border border-yellow-500 text-yellow-500 py-2 rounded-lg hover:bg-yellow-500 hover:text-white transition">
                    Lihat Detail →
                </a>
            </div>


            <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-500">Pengaduan Selesai</p>
                        <h2 class="text-3xl font-bold text-green-600 mt-2">
                            {{ $pengaduanSelesai }}
                        </h2>
                    </div>
                    <div class="text-green-600 text-4xl">
                        ✅
                    </div>
                </div>

                <a href="{{ route('admin.aspirasi.index', ['status' => 'Selesai']) }}"
                    class="mt-4 block text-center border border-green-600 text-green-600 py-2 rounded-lg hover:bg-green-600 hover:text-white transition">
                    Lihat Detail →
                </a>
            </div>

        </div>

        <div class="bg-white rounded-xl shadow p-6">

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-semibold">
                    Pengaduan Terbaru
                </h3>
                <a href="{{ route('admin.aspirasi.index') }}" class="text-blue-600 hover:underline text-sm">
                    Lihat Semua
                </a>
            </div>


            <div class="grid md:grid-cols-2 gap-6">

                @forelse ($pengaduanTerbaru as $item)
                    <div class="border rounded-lg p-4 bg-gray-50 hover:shadow-md transition">

                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-semibold">{{ $item->siswa->nama }}</p>
                                <p class="text-sm text-gray-500">
                                    {{ $item->lokasi }} •
                                    {{ $item->created_at->diffForHumans() }}
                                </p>
                            </div>

                            @if ($item->aspirasi)
                                @php
                                    $color = match ($item->aspirasi->status) {
                                        'Menunggu' => 'bg-yellow-400',
                                        'Proses' => 'bg-blue-500',
                                        'Selesai' => 'bg-green-500',
                                        default => 'bg-gray-400',
                                    };
                                @endphp

                                <span class="{{ $color }} text-white text-xs px-3 py-1 rounded-full">
                                    {{ $item->aspirasi->status }}
                                </span>
                            @else
                                <span class="bg-gray-400 text-white text-xs px-3 py-1 rounded-full">
                                    Baru
                                </span>
                            @endif
                        </div>

                        <p class="text-sm text-gray-600 mb-3">
                            {{ Str::limit($item->ket, 80) }}
                        </p>

                        <div class="flex justify-between items-center">
                            <span class="bg-gray-200 text-gray-700 text-xs px-3 py-1 rounded-full">
                                {{ $item->category->ket_category }}
                            </span>

                            <a href="{{ route('admin.aspirasi.editStatus', $item->id_pelaporan) }}"
                                class="text-blue-600 hover:underline text-sm">
                                Kelola →
                            </a>
                        </div>

                    </div>

                @empty
                    <div class="col-span-2 text-center text-gray-500 py-8">
                        Belum ada pengaduan
                    </div>
                @endforelse

            </div>

        </div>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const ctx = document.getElementById('chartAspirasi');

            const dataValues = [
                {{ $pengaduanMenunggu }},
                {{ $pengaduanProses }},
                {{ $pengaduanSelesai }}
            ];

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Menunggu', 'Proses', 'Selesai'],
                    datasets: [{
                        data: dataValues,
                        backgroundColor: [
                            '#facc15', // kuning
                            '#3b82f6', // biru
                            '#22c55e' // hijau
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let total = dataValues.reduce((a, b) => a + b, 0);
                                    let value = context.raw;
                                    let percentage = total ? ((value / total) * 100).toFixed(1) : 0;
                                    return `${context.label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });

        });
    </script>
@endsection
