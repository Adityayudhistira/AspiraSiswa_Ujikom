<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen bg-gray-100">

    <div class="flex h-screen">

        <!-- LEFT SIDE -->
        <div class="hidden md:flex w-1/2 bg-blue-600 text-white flex-col justify-center px-16">
            <h2 class="text-3xl font-bold mb-4">
                Selamat Datang Kembali 👋
            </h2>

            <p class="text-blue-100 leading-relaxed">
                Masuk ke akun Anda untuk melanjutkan pengajuan
                atau melihat status laporan Anda.
            </p>

            <div class="mt-10 text-sm text-blue-200">
                <p class="italic">
                    "Aspirasi membantu dalam menyelesaikan masalah
                    di lingkungan kami. Terima kasih!"
                </p>
                <p class="mt-2 font-semibold">- Siswa</p>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="flex w-full md:w-1/2 items-center justify-center px-6">

            <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">

                <h4 class="text-xl font-semibold text-gray-800">
                    Masuk ke Akun Anda
                </h4>

                <p class="text-sm text-gray-500 mb-6">
                    Silakan masukkan NIS dan password Anda
                </p>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-4">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('loginProses') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- NIS -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            NIS
                        </label>
                        <input type="text" name="nis" placeholder="Masukkan NIS"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none"
                            required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Password
                        </label>
                        <input type="password" name="password" placeholder="Masukkan Password"
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:border-blue-400 outline-none"
                            required>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-medium shadow transition">
                        Masuk
                    </button>
                </form>

            </div>

        </div>

    </div>

</body>

</html>
