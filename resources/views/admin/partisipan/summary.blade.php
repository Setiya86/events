@extends('admin.layouts.app')

@section('title', 'Events List')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-3xl font-bold mb-6">📊 Ringkasan Event dan Partisipan</h1>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="py-3 px-4 text-left">Event Title</th>
                    <th class="py-3 px-4 text-left">Description</th>
                    <th class="py-3 px-4 text-left">Number of participants</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="border-t hover:bg-gray-50">
                @forelse ($events as $event)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="py-3 px-4 font-semibold">{{ $event->title }}</td>
                        <td class="py-3 px-4">{{ Str::limit($event->description, 80) }}</td>
                        <td class="px-6 py-4 text-center">{{ $event->submissions_count }}</td>
                        <td class="py-3 px-4">
                            <a href="{{ route('partisipan.participants.detail', $event->id) }}" 
                               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                                Lihat Peserta
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-3 px-4 text-center text-gray-500">Tidak ada data event</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
