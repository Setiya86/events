@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-blue-600 to-black px-4">
    <div class="max-w-xl w-full p-6 bg-white rounded-xl shadow text-center">
        <h2 class="text-2xl font-bold mb-4 text-blue-800">QR Code Kehadiran</h2>
        <p class="mb-4 text-gray-600">Silakan scan QR berikut saat hadir di lokasi:</p>
        <div class="flex justify-center">
            {!! $qr !!}
        </div>
    </div>
</div>
@endsection
