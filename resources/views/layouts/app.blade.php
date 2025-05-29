<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 'id' => 'BRG-' . str_pad($report->id, 3, '0', STR_PAD_LEFT), -->
    <title>{{$title}} - LostNFound</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: '#773b97',
                        secondary: '#a868cb',
                        hitam: '1b1b1b',
                        oren: '#f05a26',
                        kuning: '#fbbc2a',
                    },
                }
            }
        }
    </script>
    @yield('header')
</head>

<body class="font-poppins scroll-smooth">
    {{-- Navbar --}}
    <div class="absolute top-0 left-0 z-40 w-full bg-transparent">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                <!-- Logo -->
                <a href="/" class="w-48">
                    <img src="{{ asset('storage/logo-lostnfound.svg') }}" alt="logo" class="w-full" />
                </a>
                @if (auth()->check())
                    <!-- User Icon -->
                    <div class="group relative flex items-center">
                        <img src="{{ asset('storage/logo-user.svg') }}" class="w-12 cursor-pointer" />

                        <div
                            class="absolute top-full right-0 mt-2 w-40 bg-white rounded-lg shadow-2xl origin-top scale-y-0 group-hover:scale-y-100 transition-transform duration-200">
                        <a href="{{ route('history') }}"
                                class="block px-4 py-2 text-hitam hover:bg-gray-100 font-medium">Riwayat Klaim</a>
                            <form action="{{ route('auth.logout') }}" method="post"
                                class="block px-4 py-2 text-hitam hover:bg-gray-100 font-medium">
                                @csrf
                                <button type="submit">Keluar</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login"
                        class="bg-primary text-white px-6 py-2 rounded-lg font-semibold hover:bg-secondary transition">Login</a>
                @endif
            </div>
        </div>
    </div>
    @yield('content')
    @yield('scripts')

</body>

</html>
