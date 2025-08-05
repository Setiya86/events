<header class="px-6 py-3 flex justify-end items-center w-full">
    <div class="flex items-center space-x-3">
        <span class="text-gray-600">Hi, {{ auth()->user()->name ?? 'Admin' }}</span>
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}" 
             class="w-8 h-8 rounded-full border">
    </div>
</header>
