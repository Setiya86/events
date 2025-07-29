<header class="bg-slate-50 p-6 flex justify-between items-center">
    <h2 class="text-xl font-bold text-gray-700">
        @yield('title', 'Dashboard')
    </h2>

    <div class="flex items-center space-x-4">
        <span class="text-gray-600">Hi, {{ auth()->user()->name ?? 'Admin' }}</span>
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}" 
             class="w-8 h-8 rounded-full border">
    </div>
</header>
