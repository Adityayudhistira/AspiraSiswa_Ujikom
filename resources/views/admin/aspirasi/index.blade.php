<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Aspirasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>

<body>

    @extends('admin.layout.sidebar')

    @section('content')
        <div class="container mt-4">
            <h2 class="mb-4">📊 Kelola Semua Aspirasi</h2>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- STATISTIK CARD -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <h5 class="card-title">📈 Total Aspirasi</h5>
                            <h2 class="mb-0">{{ $stats['total'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <h5 class="card-title">⏳ Menunggu</h5>
                            <h2 class="mb-0">{{ $stats['menunggu'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h5 class="card-title">⚙️ Proses</h5>
                            <h2 class="mb-0">{{ $stats['proses'] }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <h5 class="card-title">✅ Selesai</h5>
                            <h2 class="mb-0">{{ $stats['selesai'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FILTER CARD -->
            <div class="card mb-4">
                <div class="card-header bg-blue-500 text-white">
                    <h5 class="mb-0">🔍 Filter Aspirasi</h5>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.aspirasi.index') }}">
                        <div class="row g-3">

                            <!-- Filter Rentang Tanggal -->
                            <div class="col-md-4">
                                <label class="form-label fw-bold">📅 Dari Tanggal</label>
                                <input type="date" class="form-control" name="tanggal_awal"
                                    value="{{ request('tanggal_awal') }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">📅 Sampai Tanggal</label>
                                <input type="date" class="form-control" name="tanggal_akhir"
                                    value="{{ request('tanggal_akhir') }}">
                            </div>
                            <!-- Filter Siswa -->
                            <div class="col-md-3">
                                <label class="form-label fw-bold">👤 Siswa</label>
                                <select class="form-select" name="nis">
                                    <option value="">Semua Siswa</option>
                                    @foreach ($siswas as $siswa)
                                        <option value="{{ $siswa->nis }}"
                                            {{ request('nis') == $siswa->nis ? 'selected' : '' }}>
                                            {{ $siswa->nama }} ({{ $siswa->nis }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filter Kategori -->
                            <div class="col-md-2">
                                <label class="form-label fw-bold">📂 Kategori</label>
                                <select class="form-select" name="id_category">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id_category }}"
                                            {{ request('id_category') == $cat->id_category ? 'selected' : '' }}>
                                            {{ $cat->ket_category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filter Status -->
                            <div class="col-md-2">
                                <label class="form-label fw-bold">📊 Status</label>
                                <select class="form-select" name="status">
                                    <option value="">Semua Status</option>
                                    <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>
                                        Menunggu</option>
                                    <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses
                                    </option>
                                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Filter
                                </button>
                                <a href="{{ route('admin.aspirasi.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-clockwise"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- TABEL ASPIRASI -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-danger">
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($query as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->siswa->nama }}</td>
                                        <td>{{ $item->siswa->kelas }}</td>
                                        <td><span class="badge bg-secondary">{{ $item->category->ket_category }}</span>
                                        </td>
                                        <td>{{ Str::limit($item->lokasi, 15) }}</td>
                                        <td>{{ Str::limit($item->ket, 30) }}</td>
                                        <td>
                                            @if ($item->aspirasi)
                                                @php
                                                    $status = $item->aspirasi->status;
                                                    $badge = match ($status) {
                                                        'Menunggu' => 'warning',
                                                        'Proses' => 'info',
                                                        'Selesai' => 'success',
                                                        default => 'secondary',
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $badge }}">{{ $status }}</span>
                                            @else
                                                <span class="badge bg-secondary">Belum Diproses</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">

                                                <!-- Tombol Edit -->
                                                <a href="{{ route('admin.aspirasi.editStatus', $item->id_pelaporan) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <!-- Tombol Delete -->
                                                <form action="{{ route('admin.aspirasi.destroy', $item->id_pelaporan) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus aspirasi ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">
                                            <em>Tidak ada data aspirasi
                                                {{ request()->anyFilled(['tanggal', 'bulan', 'nis', 'id_category', 'status']) ? 'dengan filter tersebut' : '' }}</em>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($query->count() > 0)
                        <div class="alert alert-info mt-3 mb-0">
                            <strong>📊 Total hasil filter:</strong> {{ $query->count() }} aspirasi
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
