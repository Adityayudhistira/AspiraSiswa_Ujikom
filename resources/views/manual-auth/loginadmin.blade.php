<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen font-sans">
    <div class="grid md:grid-cols-2 min-h-screen">

        <!-- LEFT PANEL -->
        <div class="hidden md:flex flex-col justify-center px-16 bg-blue-600 text-white">
            <h2 class="text-4xl font-bold mb-4">
                Admin Dashboard Akses
            </h2>

            <p class="text-lg opacity-90 leading-relaxed">
                Masuk sebagai administrator untuk mengelola
                data aspirasi, kategori, dan laporan sistem.
            </p>

            <div class="mt-10 text-sm opacity-80">
                <p>
                    "Kelola sistem dengan bijak dan transparan
                    untuk pelayanan terbaik."
                </p>
                <p class="mt-2 font-semibold">- Admin</p>
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="flex items-center justify-center bg-slate-100 px-6">

            <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

                <h4 class="text-2xl font-semibold text-gray-800 mb-2">
                    Masuk ke Dashboard Admin
                </h4>

                <p class="text-gray-500 mb-6 text-sm">
                    Silakan masukkan username dan password
                </p>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.loginProses') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Username -->
                    <div>
                        <label class="text-sm font-medium text-gray-600">Username</label>
                        <input type="text" name="username"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Masukkan Username" required autofocus>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="text-sm font-medium text-gray-600">Password</label>
                        <input type="password" name="password"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            placeholder="Masukkan Password" required>
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full bg-slate-900 hover:bg-slate-800 text-white py-2 rounded-lg font-medium transition">
                        Masuk ke Dashboard
                    </button>

                    <!-- Register -->
                    <p class="text-center text-sm text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('admin.register') }}" class="text-blue-500 hover:underline">
                            Daftar sekarang
                        </a>
                    </p>

                    <!-- Login siswa -->
                    <p class="text-center text-sm text-gray-500">
                        Login sebagai
                        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                            Siswa
                        </a>
                    </p>

                </form>

            </div>

        </div>

    </div>

</body>

</html>
