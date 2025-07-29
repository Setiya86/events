@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('bodyClass', 'bg-gray-100 min-h-screen')

@section('content')
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg hidden md:block">
        <div class="p-6 border-b">
            <h1 class="text-2xl font-bold text-cyan-600">QR Events</h1>
        </div>
        <nav class="p-4 space-y-2">
            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100 text-gray-700 font-medium">Dashboard</a>
            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100 text-gray-700 font-medium">Manage Events</a>
            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100 text-gray-700 font-medium">Participants</a>
            <a href="#" class="block px-3 py-2 rounded hover:bg-gray-100 text-gray-700 font-medium">QR Scan</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1">
        <!-- Navbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-700">Dashboard</h2>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Logout
                </button>
            </form>
        </header>

        <!-- Dashboard Content -->
        <main class="p-6">
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-gradient-to-r from-cyan-400 to-cyan-600 text-white p-5 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Total Events</h3>
                    <p class="text-3xl font-bold mt-2">5</p>
                </div>
                <div class="bg-gradient-to-r from-green-400 to-green-600 text-white p-5 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Total Participants</h3>
                    <p class="text-3xl font-bold mt-2">120</p>
                </div>
                <div class="bg-gradient-to-r from-blue-400 to-blue-600 text-white p-5 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">QR Scans Today</h3>
                    <p class="text-3xl font-bold mt-2">30</p>
                </div>
            </div>

            <!-- Event List -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-700">Upcoming Events</h3>
                    <a href="#" class="bg-cyan-500 text-white px-4 py-2 rounded hover:bg-cyan-600">+ New Event</a>
                </div>
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                            <th class="py-3 px-4">Event Name</th>
                            <th class="py-3 px-4">Date</th>
                            <th class="py-3 px-4">Participants</th>
                            <th class="py-3 px-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="py-3 px-4">Tech Conference 2025</td>
                            <td class="py-3 px-4">12 Aug 2025</td>
                            <td class="py-3 px-4">50</td>
                            <td class="py-3 px-4 text-center">
                                <a href="#" class="text-blue-500 hover:underline">Edit</a> |
                                <a href="#" class="text-red-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-3 px-4">Startup Meetup</td>
                            <td class="py-3 px-4">20 Aug 2025</td>
                            <td class="py-3 px-4">30</td>
                            <td class="py-3 px-4 text-center">
                                <a href="#" class="text-blue-500 hover:underline">Edit</a> |
                                <a href="#" class="text-red-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                        <!-- Tambahkan event lainnya di sini -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@endsection
