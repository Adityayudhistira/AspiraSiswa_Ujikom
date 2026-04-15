<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-linear-to-br from-blue-600 via-blue-700 to-blue-900 flex items-center justify-center">

    <div
        class="w-full max-w-5xl bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden grid md:grid-cols-2">

        <div class="hidden md:flex flex-col justify-center p-10 text-white">
            <h2 class="text-3xl font-bold mb-4">
                Admin Dashboard
            </h2>

            <p class="text-blue-100 leading-relaxed mb-6">
                Kelola aspirasi siswa, kategori, dan sistem
                dengan mudah dalam satu dashboard terintegrasi.
            </p>

            <div class="bg-white/10 p-4 rounded-xl text-sm">
                <p class="italic">
                    "Kontrol sistem dengan bijak dan transparan."
                </p>
                <p class="mt-2 font-semibold">- Administrator</p>
            </div>
        </div>

        <div class="bg-white p-8 md:p-10">

            <h3 class="text-2xl font-bold text-gray-800 mb-2">
                Login Admin
            </h3>

            <p class="text-sm text-gray-500 mb-6">
                Masukkan username dan password Anda
            </p>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.loginProses') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="text-sm font-medium text-gray-600">Username</label>
                    <input type="text" name="username"
                        class="w-full mt-1 px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        placeholder="Masukkan Username" required autofocus>
                </div>

                <div>
                    <label class="text-sm font-medium text-gray-600">Password</label>
                    <input type="password" name="password"
                        class="w-full mt-1 px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        placeholder="Masukkan Password" required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition">
                    Masuk ke Dashboard
                </button>

                <div class="text-center space-y-2 mt-4">

                    <p class="text-sm text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('admin.register') }}" class="text-blue-600 font-medium hover:underline">
                            Daftar sekarang
                        </a>
                    </p>

                    <p class="text-sm text-gray-500">
                        Login sebagai
                        <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                            Siswa
                        </a>
                    </p>

                </div>

            </form>

        </div>

    </div>

</body>

</html>
