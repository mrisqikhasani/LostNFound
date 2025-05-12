<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body class="bg-gray-100 text-gray-800">
    <nav class="bg-white shadow p-4 flex justify-between">
        <a href="/" class="font-bold">{{ config('app.name') }}</a>
        @auth
            <form method="POST" action="{{ route('logout') }}">
                <span>{{ Auth::user()->name }}</span>
                <button href="{{ route('logout') }}" class="ml-4 text-red-500">Logout</button>
            </form>
        @endauth
    </nav>

    <main class="p-6">
        @yield('content')
    </main>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    @yield('scripts')
</body>
</html>
