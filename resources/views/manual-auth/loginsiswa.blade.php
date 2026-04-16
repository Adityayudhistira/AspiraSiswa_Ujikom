<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-blue-600 via-blue-700 to-blue-900 flex items-center justify-center">

    <div
        class="w-full max-w-5xl bg-white/10 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden grid md:grid-cols-2">

        <div class="hidden md:flex flex-col justify-center p-10 text-white">
            <h2 class="text-3xl font-bold mb-4">
                Portal Aspirasi Siswa
            </h2>

            <p class="text-blue-100 leading-relaxed mb-6">
                Tempat bagi siswa untuk menyampaikan ide, keluhan, dan masukan
                demi menciptakan lingkungan sekolah yang lebih baik, nyaman, dan berkembang bersama.
            </p>

            <div class="bg-white/10 p-4 rounded-xl text-sm">
                <p class="italic">
                    "Suaramu berarti. Sampaikan, dan jadilah bagian dari perubahan."
                </p>
                <p class="mt-2 font-semibold">- Sistem Aspirasi Sekolah</p>
            </div>
        </div>

        <div class="bg-white p-8 md:p-10">

            <h3 class="text-2xl font-bold text-gray-800 mb-2">
                Login Siswa
            </h3>

            <p class="text-sm text-gray-500 mb-6">
                Masukkan NIS dan password Anda
            </p>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('loginProses') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        NIS
                    </label>
                    <input type="text" name="nis" placeholder="Masukkan NIS"
                        class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Password
                    </label>
                    <input type="password" name="password" placeholder="Masukkan Password"
                        class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                        required>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition">
                    Masuk
                </button>
            </form>

            <p class="text-xs text-gray-400 mt-6 text-center">
                © {{ date('Y') }} Portal Aspirasi Sekolah
            </p>

        </div>

    </div>

</body>

</html>
