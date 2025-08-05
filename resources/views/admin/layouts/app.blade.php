<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-slate-50 h-screen overflow-hidden @yield('bodyClass')">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div id="sidebar" class="w-64 h-screen flex-shrink-0 overflow-y-auto hidden md:block">
            @include('admin.events.partials.sidebar')
        </div>


        <!-- Main Content Wrapper -->
        <div class="flex flex-col flex-1">
            <!-- Navbar -->
            <div class="h-16 flex justify-end">
                @include('admin.events.partials.navbar')
            </div>

            <!-- Scrollable Main -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>

</html>