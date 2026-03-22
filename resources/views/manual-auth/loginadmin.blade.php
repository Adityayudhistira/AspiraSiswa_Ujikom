<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
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

        /* LEFT PANEL (ADMIN STYLE) */
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
            opacity: 0.85;
        }

        /* RIGHT PANEL */
        .right-panel {
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            width: 360px;
        }

        .login-box h4 {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .form-control {
            height: 45px;
        }

        .btn-login {
            background: #1e293b;
            border: none;
            height: 45px;
            font-weight: 500;
        }

        .btn-login:hover {
            background: #0f172a;
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
                <h2>Admin Dashboard Akses</h2>
                <p>
                    Masuk sebagai administrator untuk mengelola
                    data aspirasi, kategori, dan laporan sistem.
                </p>

                <div class="mt-5">
                    <small>
                        "Kelola sistem dengan bijak dan transparan
                        untuk pelayanan terbaik."
                    </small>
                    <br>
                    <strong>- Admin</strong>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="col-md-6 right-panel">
                <div class="login-box">

                    <h4>Masuk ke Dashboard Admin</h4>
                    <p class="text-muted mb-4">
                        Silakan masukkan username dan password
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('admin.loginProses') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Masukkan Username"
                                required autofocus>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password"
                                required>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-login text-white">
                                Masuk ke Dashboard
                            </button>
                        </div>

                        <div class="text-center small-link">
                            Login sebagai
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                Siswa
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</body>

</html>
