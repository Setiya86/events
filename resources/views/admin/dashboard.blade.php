@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')
@section('bodyClass', 'bg-slate-50 min-h-screen')

@section('content')
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
<div class="p-4">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-bold text-gray-700">Upcoming Events</h3>
        <a href="{{ route('events.create') }}" 
           class="bg-cyan-500 text-white px-4 py-2 rounded hover:bg-cyan-600">
           + New Event
        </a>
    </div>
    @include('admin.events.table')
</div>
@endsection
