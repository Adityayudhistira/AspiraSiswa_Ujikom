<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aspirasi</title>
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
                        <h4 class="mb-0">➕ Tambah Aspirasi Baru</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Terjadi kesalahan!</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('input-aspirasi.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="id_category" class="form-label fw-bold">Kategori <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('id_category') is-invalid @enderror" id="id_category"
                                    name="id_category" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id_category }}"
                                            {{ old('id_category') == $cat->id_category ? 'selected' : '' }}>
                                            {{ $cat->ket_category }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lokasi" class="form-label fw-bold">Lokasi <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                    id="lokasi" name="lokasi" value="{{ old('lokasi') }}"
                                    placeholder="Contoh: Ruang Kelas 10A" maxlength="50" required>
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="ket" class="form-label fw-bold">Keterangan <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('ket') is-invalid @enderror" id="ket" name="ket" rows="4"
                                    placeholder="Jelaskan aspirasi Anda..." maxlength="50" required>{{ old('ket') }}</textarea>
                                @error('ket')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Maksimal 50 karakter</small>
                            </div>

                            <div class="alert alert-info">
                                <strong>📌 Catatan:</strong> NIS Anda (<code>{{ Auth::user()->nis }}</code>) akan
                                otomatis tercatat.
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    💾 Kirim Aspirasi
                                </button>
                                <a href="{{ route('input-aspirasi.index') }}" class="btn btn-secondary">
                                    ❌ Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
