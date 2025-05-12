<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <form method="POST" action="/login" class="bg-white p-6 rounded shadow-md w-80">
        @csrf
        <h1 class="text-xl font-bold mb-4">Login</h1>

        @if ($errors->any())
            <div class="text-red-500 mb-2 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded" required autofocus>
        </div>

        <div class="mb-4">
            <label>Password</label>
            <input type="password" name="password" class="w-full border p-2 rounded" required>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Login</button>
    </form>
</body>
</html>
