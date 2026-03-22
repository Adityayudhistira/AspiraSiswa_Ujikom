<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">🧑‍🎓 Portal Siswa</a>
            <div class="d-flex">
                <span class="navbar-text me-3">
                    Halo, <strong>{{ Auth::user()->nama }}</strong>
                </span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>📋 Semua Aspirasi Siswa</h2>
            <a href="{{ route('input-aspirasi.create') }}" class="btn btn-primary">
                ➕ Tambah Aspirasi
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($query as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nis }}</td>
                                    <td>
                                        {{ $item->siswa->nama }}
                                        @if ($item->nis === Auth::user()->nis)
                                            <span class="badge bg-info">Saya</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->category->ket_category }}</td>
                                    <td>{{ $item->lokasi }}</td>
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
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a href="{{ route('input-aspirasi.show', $item->id_pelaporan) }}"
                                            class="btn btn-sm btn-info">
                                            Detail
                                        </a>

                                        @if ($item->nis === Auth::user()->nis)
                                            <form action="{{ route('input-aspirasi.destroy', $item->id_pelaporan) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Yakin ingin hapus aspirasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center">Belum ada aspirasi</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="alert alert-info mt-3">
            <strong>ℹ️ Info:</strong> Siswa tidak dapat mengedit aspirasi setelah dikirim. Jika ada kesalahan, silakan
            hapus dan buat aspirasi baru.
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
