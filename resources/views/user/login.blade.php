<!DOCTYPE html>
<html lang="en">

<head>
    <title>Masuk - LostNFound</title>
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
                    },
                }
            }
        }
    </script>
</head>

<body class="min-h-screen overflow-y-auto font-poppins relative">
    <section class="flex justify-center relative">
        <img src="{{ asset('storage/background-lostnfound.jpg') }}" alt="gradient background image"
            class="w-full h-full object-cover fixed">
        <div class="mx-auto max-w-lg px-6 lg:px-8 absolute py-20 w-full">
            <img src="{{ asset('storage/logo-lostnfound.svg') }}" alt="LostNFound Logo"
                class="mx-auto w-64 lg:mb-11 mb-8 object-cover">
            <div class="rounded-2xl bg-white shadow-xl">
                <form method="post" action="/login" class="lg:p-11 p-7 mx-auto">
                    @csrf
                    <div class="mb-11">
                        <p class="font-poppins leading-10 text-center text-3xl font-bold tracking-tight text-gray-900">
                            Login</p>
                    </div>
                    @if ($errors->any())
                        <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <input type="text"
                        class="w-full h-12 text-gray-900 placeholder:text-gray-400 text-lg font-normal leading-7 rounded-lg border-gray-300 border shadow-sm px-4 mb-6 focus:outline-primary"
                        placeholder="Email" name="email">
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Password"
                            class="w-full h-12 text-gray-900 placeholder:text-gray-400 text-lg font-normal leading-7 rounded-lg border border-gray-300 shadow-sm focus:outline-primary px-4 pr-12"
                        />
                        <span
                            id="togglePassword"
                            class="absolute top-1/2 right-4 -translate-y-1/2 text-gray-500 cursor-pointer"
                        >
                            <i class="fa-regular fa-eye"></i>
                        </span>
                    </div>
                    <button
                        class="mt-10 w-full h-12 text-white text-center text-lg font-semibold leading-6 rounded-lg hover:bg-secondary transition-all ease-in-out duration-300 bg-primary shadow-sm mb-11">Masuk</button>
                    <p class="flex justify-center text-gray-900 text-lg font-medium leading-6">Belum
                        punya akun?<a href="/register"
                            class="text-primary font-semibold pl-3 no-underline hover:underline hover:text-secondary">Daftar</a>
                    </p>
                </form>
            </div>
        </div>
    </section>

    <script>
        const togglePassword = document.getElementById("togglePassword");
        const password = document.getElementById("password");

        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // Toggle icon between eye and eye-slash
            this.innerHTML = type === "password"
                ? '<i class="fa-regular fa-eye"></i>'
                : '<i class="fa-regular fa-eye-slash"></i>';
        });
    </script>
</body>

</html>
