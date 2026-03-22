<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aspirasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('input-aspirasi.index') }}">🧑‍🎓 Portal Siswa</a>
            <span class="navbar-text">
                Halo, <strong>{{ Auth::user()->nama }}</strong>
            </span>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">📄 Detail Aspirasi</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th width="200">NIS</th>
                                <td>{{ $inputAspirasi->nis }}</td>
                            </tr>
                            <tr>
                                <th>Nama Siswa</th>
                                <td>{{ $inputAspirasi->siswa->nama }}</td>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <td>{{ $inputAspirasi->siswa->kelas }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td><span class="badge bg-secondary">{{ $inputAspirasi->category->ket_category }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Lokasi</th>
                                <td>{{ $inputAspirasi->lokasi }}</td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>{{ $inputAspirasi->ket }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($inputAspirasi->aspirasi)
                                        @php
                                            $status = $inputAspirasi->aspirasi->status;
                                            $badge = match ($status) {
                                                'Menunggu' => 'warning',
                                                'Proses' => 'info',
                                                'Selesai' => 'success',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $badge }} fs-6">{{ $status }}</span>
                                    @else
                                        <span class="badge bg-secondary fs-6">Belum Diproses</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Feedback Admin</th>
                                <td>
                                    @if ($inputAspirasi->aspirasi && $inputAspirasi->aspirasi->feedback)
                                        <div class="alert alert-info mb-0">
                                            {{ $inputAspirasi->aspirasi->feedback }}
                                        </div>
                                    @else
                                        <em class="text-muted">Belum ada feedback dari admin</em>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Dibuat</th>
                                <td>{{ $inputAspirasi->created_at->format('d F Y, H:i') }}</td>
                            </tr>
                        </table>

                        <div class="d-flex gap-2">
                            <a href="{{ route('input-aspirasi.index') }}" class="btn btn-secondary">
                                ← Kembali
                            </a>
                            @if ($inputAspirasi->nis === Auth::user()->nis)
                                <form action="{{ route('input-aspirasi.destroy', $inputAspirasi->id_pelaporan) }}"
                                    method="POST" onsubmit="return confirm('Yakin ingin hapus aspirasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
