<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'QR Event')</title>
</head>
<body class="@yield('bodyClass', 'bg-gray-100 min-h-screen')">
    @yield('content')
</body>
</html>
