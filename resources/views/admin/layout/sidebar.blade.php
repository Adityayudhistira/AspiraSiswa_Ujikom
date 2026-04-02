<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-slate-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-gradient-to-b from-blue-700 to-blue-900 text-white flex flex-col shadow-xl">

            <!-- Logo -->
            <div class="p-6 border-b border-blue-600">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold flex items-center gap-2 tracking-wide">
                    🚀 Admin Panel
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2 text-sm">

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ Request::routeIs('admin.dashboard') ? 'bg-white text-blue-700 font-semibold shadow' : 'hover:bg-blue-600' }}">
                    🏠 Dashboard
                </a>

                <a href="{{ route('admin.aspirasi.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ Request::routeIs('admin.aspirasi.*') ? 'bg-white text-blue-700 font-semibold shadow' : 'hover:bg-blue-600' }}">
                    💬 Aspirasi
                </a>

                <a href="{{ route('admin.category.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ Request::routeIs('admin.category.*') ? 'bg-white text-blue-700 font-semibold shadow' : 'hover:bg-blue-600' }}">
                    📂 Kategori
                </a>

                <a href="{{ route('admin.siswa.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ Request::routeIs('admin.siswa.*') ? 'bg-white text-blue-700 font-semibold shadow' : 'hover:bg-blue-600' }}">
                    👨‍🎓 Siswa
                </a>

            </nav>

            <!-- Footer Sidebar -->
            <div class="p-4 text-xs text-blue-200 border-t border-blue-600">
                © {{ date('Y') }} Admin System
            </div>

        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col">

            <!-- TOPBAR -->
            <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">

                <div>
                    <h1 class="text-xl font-semibold text-gray-800">Dashboard</h1>
                    <p class="text-sm text-gray-500">Selamat datang kembali 👋</p>
                </div>

                <div class="flex items-center gap-4">

                    <!-- User Info (No Avatar) -->
                    <div class="text-right">
                        <p class="font-semibold text-gray-800">
                            {{ Auth::guard('admin')->user()->username }}
                        </p>
                        <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-md font-medium">
                            Administrator
                        </span>
                    </div>

                    <!-- Logout -->
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-medium shadow hover:shadow-md transition">
                            Logout
                        </button>
                    </form>

                </div>
            </header>

            <!-- CONTENT -->
            <main class="p-6 flex-1">
                @yield('content')
            </main>

        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>

</body>

</html>
