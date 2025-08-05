@extends('layouts.app')

@section('title', 'Checkin Berhasil')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <!-- Modal -->
    <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 text-center">
            <h2 class="text-2xl font-bold text-green-600 mb-4">✅ Check-in Berhasil</h2>
            <p class="text-gray-700 mb-6">
                Peserta <strong>{{ $submission->id }}</strong> berhasil check-in.
            </p>
            <button 
                onclick="closeModal()" 
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                OK
            </button>
        </div>
    </div>
</div>

<script>
    function closeModal() {
        document.getElementById('successModal').style.display = 'none';
    }
</script>
@endsection
