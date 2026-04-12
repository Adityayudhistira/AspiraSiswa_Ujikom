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
        <aside class="w-64 bg-gradient-to-b from-blue-700 to-blue-900 text-white flex flex-col shadow-2xl">

            <!-- LOGO -->
            <div class="p-5 border-b border-blue-500/30">
                <a href="{{ route('admin.dashboard') }}"
                    class="text-lg font-semibold flex items-center gap-2 tracking-wide">
                    ⚡ Admin Panel
                </a>
            </div>

            <!-- NAV -->
            <nav class="flex-1 p-4 space-y-2 text-sm">

                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                    class="relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ Request::routeIs('admin.dashboard')
                        ? 'bg-white text-blue-700 font-semibold shadow'
                        : 'hover:bg-white/10 hover:translate-x-1' }}">

                    @if (Request::routeIs('admin.dashboard'))
                        <span class="absolute left-0 top-0 h-full w-1 bg-white rounded-r"></span>
                    @endif

                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Dashboard
                </a>

                <!-- Aspirasi -->
                <a href="{{ route('admin.aspirasi.index') }}"
                    class="relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ Request::routeIs('admin.aspirasi.*')
                        ? 'bg-white text-blue-700 font-semibold shadow'
                        : 'hover:bg-white/10 hover:translate-x-1' }}">

                    @if (Request::routeIs('admin.aspirasi.*'))
                        <span class="absolute left-0 top-0 h-full w-1 bg-white rounded-r"></span>
                    @endif

                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                    Aspirasi
                </a>

                <!-- Kategori -->
                <a href="{{ route('admin.category.index') }}"
                    class="relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ Request::routeIs('admin.category.*')
                        ? 'bg-white text-blue-700 font-semibold shadow'
                        : 'hover:bg-white/10 hover:translate-x-1' }}">

                    @if (Request::routeIs('admin.category.*'))
                        <span class="absolute left-0 top-0 h-full w-1 bg-white rounded-r"></span>
                    @endif

                    <i data-lucide="folder" class="w-5 h-5"></i>
                    Kategori
                </a>

                <!-- Siswa -->
                <a href="{{ route('admin.siswa.index') }}"
                    class="relative flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200
                    {{ Request::routeIs('admin.siswa.*')
                        ? 'bg-white text-blue-700 font-semibold shadow'
                        : 'hover:bg-white/10 hover:translate-x-1' }}">

                    @if (Request::routeIs('admin.siswa.*'))
                        <span class="absolute left-0 top-0 h-full w-1 bg-white rounded-r"></span>
                    @endif

                    <i data-lucide="users" class="w-5 h-5"></i>
                    Siswa
                </a>

            </nav>

            <!-- FOOTER -->
            <div class="p-4 border-t border-blue-500/30 text-xs text-blue-200">
                <p>© {{ date('Y') }} Admin System</p>
            </div>

        </aside>

        <!-- MAIN -->
        <div class="flex-1 flex flex-col">

            <!-- TOPBAR -->
            <header class="bg-white/80 backdrop-blur-md border-b px-6 py-4 flex justify-between items-center shadow-sm">

                <div>
                    <h1 class="text-xl font-semibold text-gray-800">
                        Dashboard
                    </h1>
                    <p class="text-sm text-gray-500">
                        Selamat datang kembali 👋
                    </p>
                </div>

                <div class="flex items-center gap-4">

                    <!-- USER -->
                    <div class="text-right">
                        <p class="font-semibold text-gray-800">
                            {{ Auth::guard('admin')->user()->username }}
                        </p>
                        <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-full font-medium">
                            Administrator
                        </span>
                    </div>

                    <!-- LOGOUT -->
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
