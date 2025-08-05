<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-slate-50 @yield('bodyClass')">

<div class="min-h-screen flex">
    <!-- Sidebar -->
    @include('admin.events.partials.sidebar')

    <!-- Main Content -->
    <div class="flex-1">
        <!-- Navbar -->
        @include('admin.events.partials.navbar')

        <!-- Dynamic Content -->
        <main class="p-6">
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
