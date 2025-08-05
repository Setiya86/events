@extends('layouts.app')

@section('title', 'Sudah Checkin')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <!-- Modal -->
    <div id="infoModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 text-center">
            <h2 class="text-2xl font-bold text-yellow-600 mb-4">⚠️ Sudah Check-in</h2>
            <p class="text-gray-700 mb-6">
                Peserta ini sudah melakukan check-in sebelumnya.
            </p>
            <button 
                onclick="closeModal()" 
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                OK
            </button>
        </div>
    </div>
</div>

<script>
    function closeModal() {
        document.getElementById('infoModal').style.display = 'none';
    }
</script>
@endsection
