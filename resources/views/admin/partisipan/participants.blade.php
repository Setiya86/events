@extends('admin.layouts.app')

@section('title', 'Detail Peserta')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">👥 Detail Peserta Event: {{ $event->title }}</h1>

    <a href="{{ route('partisipan.summary') }}" class="mb-6 inline-block text-blue-600 hover:underline">
        ← Kembali ke Ringkasan Event
    </a>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="py-3 px-4 text-left">No</th>
                    @foreach ($event->fields as $field)
                        <th class="py-3 px-4 text-center">{{ ucfirst($field->label) }}</th>
                    @endforeach
                    <th class="py-3 px-4 text-center">Attendance Status</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="border-t hover:bg-gray-50">
                @forelse ($submissions as $index => $submission)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $index + 1 }}</td>

                        @foreach ($event->fields as $field)
                            <td class="py-3 px-4 font-semibold">
                                {{
                                    $submission->answers->firstWhere('field_id', $field->id)?->value ?? '—'
                                }}
                            </td>
                        @endforeach

                        <td class="py-3 px-4 text-center">
                            @if ($submission->is_present)
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">Hadir</span>
                            @else
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-semibold">Belum Hadir</span>
                            @endif
                        </td>

                        <td class="py-3 px-4 text-center">
                            <form action="{{ route('partisipan.participant.delete', $submission->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus peserta ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                        <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($event->fields) + 3 }}" class="py-3 px-4 text-center text-gray-500">Belum ada peserta.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
