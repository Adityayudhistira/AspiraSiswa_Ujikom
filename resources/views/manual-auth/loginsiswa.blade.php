<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .container-fluid {
            height: 100vh;
        }

        .left-panel {
            background: #2f5fd0;
            color: white;
            padding: 80px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .left-panel h2 {
            font-weight: 700;
            margin-bottom: 20px;
        }

        .left-panel p {
            opacity: 0.9;
        }

        .right-panel {
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            width: 350px;
        }

        .login-box h4 {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .form-control {
            height: 45px;
        }

        .btn-login {
            background: #2f5fd0;
            border: none;
            height: 45px;
            font-weight: 500;
        }

        .btn-login:hover {
            background: #1e4db7;
        }

        .small-link {
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row h-100">

            <!-- LEFT SIDE -->
            <div class="col-md-6 left-panel">
                <h2>Selamat Datang Kembali</h2>
                <p>
                    Masuk ke akun Anda untuk melanjutkan pengajuan
                    atau melihat status laporan Anda.
                </p>

                <div class="mt-5">
                    <small>
                        "Aspirasi membantu dalam menyelesaikan
                        masalah di lingkungan kami. Terima kasih!"
                    </small>
                    <br>
                    <strong>- Siswa</strong>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="col-md-6 right-panel">
                <div class="login-box">

                    <h4>Masuk ke Akun Anda</h4>
                    <p class="text-muted mb-4">
                        Silakan masukkan NIS dan password Anda
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('loginProses') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small">NIS</label>
                            <input type="text" name="nis" class="form-control" placeholder="Masukkan NIS"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password"
                                required>
                        </div>
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-login text-white">
                                Masuk
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</body>

</html>
