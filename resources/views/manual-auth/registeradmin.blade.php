<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen">

    <div class="grid md:grid-cols-2 h-full">

        <!-- LEFT PANEL -->
        <div class="bg-blue-600 text-white flex flex-col justify-center px-16 py-10">
            <h2 class="text-3xl font-bold mb-4">
                Daftar Admin Baru
            </h2>

            <p class="opacity-80">
                Buat akun administrator untuk mengelola
                sistem aspirasi sekolah dengan aman dan efisien.
            </p>

            <div class="mt-10 text-sm opacity-80">
                "Kelola sistem dengan bijak dan transparan
                untuk pelayanan terbaik."
                <br>
                <span class="font-semibold">- Admin</span>
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="bg-slate-100 flex items-center justify-center px-6">

            <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl">

                <h3 class="text-xl font-semibold mb-1">
                    Buat Akun Admin
                </h3>

                <p class="text-sm text-gray-500 mb-6">
                    Isi data di bawah untuk mendaftar
                </p>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('admin.register.proses') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Username -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Username</label>
                        <input type="text" name="username"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                            placeholder="Masukkan username" required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none"
                            placeholder="Masukkan password" required>
                    </div>

                    <button type="submit"
                        class="w-full bg-slate-900 hover:bg-black text-white py-2 rounded-lg font-medium transition">
                        🚀 Daftar Admin
                    </button>

                    <p class="text-center text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('admin.login') }}" class="text-blue-500 hover:underline">
                            Login
                        </a>
                    </p>

                </form>

            </div>

        </div>

    </div>

</body>

</html>
