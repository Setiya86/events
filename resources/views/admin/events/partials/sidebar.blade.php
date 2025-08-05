<aside class="w-64 bg-white shadow-lg hidden md:flex flex-col justify-between">
    <!-- Bagian atas -->
    <div>
        <!-- Logo -->
        <div class="p-1 flex justify-center top-18 -mt-14">
            <img src="{{ asset('img/logos.png') }}" 
                 alt="Logo" 
                 class="max-h-50 w-auto object-contain">
        </div>

        <!-- Menu -->
        <nav class="p-6 space-y-2 -mt-14 border-t">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-2 px-3 py-2 rounded font-medium 
                     {{ request()->routeIs('admin.dashboard') ? 'bg-cyan-100 text-cyan-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-tachometer-alt {{ request()->routeIs('admin.dashboard') ? 'text-cyan-600' : 'text-gray-500' }}"></i>
                Dashboard
            </a>
            <a href="{{ route('events.index') }}" 
               class="flex items-center gap-2 px-3 py-2 rounded font-medium 
                     {{ request()->routeIs('events.index') ? 'bg-cyan-100 text-cyan-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-calendar-alt {{ request()->routeIs('events.index') ? 'text-cyan-600' : 'text-gray-500' }}"></i>
                Manage Events
            </a>
            <a href="{{ route('partisipan.summary') }}" class="flex items-center gap-2 px-3 py-2 rounded font-medium {{ request()->routeIs('partisipan.summary') ? 'bg-cyan-100 text-cyan-700' : 'text-gray-700 hover:bg-gray-100' }}">
                <i class="fas fa-users {{ request()->routeIs('partisipan.summary') ? 'text-cyan-600' : 'text-gray-500' }}"></i>
                Participants
            </a>
            <a href="{{ route('admin.scan.qr') }}" 
                class="flex items-center gap-2 px-3 py-2 rounded font-medium 
                        {{ request()->routeIs('admin.scan.qr') ? 'bg-cyan-100 text-cyan-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-qrcode {{ request()->routeIs('admin.scan.qr') ? 'text-cyan-600' : 'text-gray-500' }}"></i>
                    QR Scan
                </a>

        </nav>
    </div>

   <!-- Bagian bawah -->
    <div class="p-6 border-t">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="w-full flex items-center gap-2 bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </button>
        </form>
    </div>

</aside>
