@extends('admin.layouts.app')

@section('title', 'Events List')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-700 flex items-center gap-2">
            <i class="fas fa-calendar-alt text-cyan-600"></i> Events List
        </h2>
        <a href="{{ route('events.create') }}" 
           class="bg-cyan-500 text-white px-4 py-2 rounded-lg hover:bg-cyan-600 flex items-center gap-2">
            <i class="fas fa-plus"></i> New Event
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="py-3 px-4 text-left">Event Title</th>
                    <th class="py-3 px-4 text-left">Date</th>
                    <th class="py-3 px-4 text-left">Description</th>
                    <th class="py-3 px-4 text-left">Custom Fields</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4 font-semibold">{{ $event->title }}</td>
                        <td class="py-3 px-4">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                        <td class="py-3 px-4">{{ $event->description ?? '-' }}</td>
                        <td class="py-3 px-4">
                            @if($event->fields->count())
                                <ul class="list-disc list-inside text-sm text-gray-700">
                                    @foreach($event->fields as $field)
                                        <li>
                                            <strong>{{ $field->label }}</strong> 
                                            <span class="text-gray-500">({{ ucfirst($field->type) }})</span>
                                            
                                            {{-- Tampilkan options jika ada --}}
                                            @if(!empty($field->options) && is_array($field->options))
                                                <span class="text-gray-400">
                                                    [{{ implode(', ', $field->options) }}]
                                                </span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-gray-400">No fields</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center gap-2">
                               <a href="{{ route('events.show', $event->id) }}" 
                                class="text-blue-500 hover:text-blue-700" 
                                title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('events.edit', $event->id) }}" 
                                   class="text-green-500 hover:text-green-700" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- Tombol Delete dengan Modal -->
                                <button type="button" 
                                        class="text-red-500 hover:text-red-700" 
                                        title="Delete"
                                        onclick="openDeleteModal({{ $event->id }}, '{{ $event->title }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">No events found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black/50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md shadow-lg">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Konfirmasi Hapus</h2>
        <p class="text-gray-600 mb-6">
            Apakah Anda yakin ingin menghapus event 
            <span id="eventTitle" class="font-semibold text-red-500"></span>?
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteModal()" 
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                Batal
            </button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(eventId, eventTitle) {
        document.getElementById('eventTitle').textContent = eventTitle;
        document.getElementById('deleteForm').action = `/admin/events/${eventId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection
