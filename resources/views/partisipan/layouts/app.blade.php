<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="@yield('bodyClass')">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto">📅 Event Registration</div>
    </nav>
    <main class="container mx-auto mt-6">
        @yield('content')
    </main>
</body>
</html>
