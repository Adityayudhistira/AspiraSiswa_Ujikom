<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-blue-700 text-white flex flex-col">
            <div class="p-6 border-b border-blue-500">
                <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold flex items-center gap-2">
                    Admin Panel
                </a>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-blue-600 {{ Request::routeIs('admin.dashboard') ? 'bg-blue-600' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.aspirasi.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-blue-600 {{ Request::routeIs('admin.aspirasi.*') ? 'bg-blue-600' : '' }}">
                    Kelola Aspirasi
                </a>

                <a href="{{ route('admin.category.index') }}"
                    class="block px-4 py-2 rounded-lg hover:bg-blue-600 {{ Request::routeIs('admin.category.*') ? 'bg-blue-600' : '' }}">
                    Kelola Kategori
                </a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col">

            <!-- TOPBAR -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <div>
                    <h1 class="text-xl font-semibold">Dashboard</h1>
                    <p class="text-sm text-gray-500">Selamat datang kembali!</p>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right">
                        <p class="font-semibold">{{ Auth::guard('admin')->user()->username }}</p>
                        <p class="text-sm text-gray-500">Administrator</p>
                    </div>

                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
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

</body>

</html>
