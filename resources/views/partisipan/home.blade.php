@extends('layouts.app')

@section('content')
<div class="bg-gradient-to-b from-blue-600 via-blue-800 to-black min-h-screen py-12 px-4 text-white relative overflow-hidden">

    <!-- Ornamen SVG Hiasan -->
    <div class="absolute top-0 left-0 opacity-10 w-64 h-64 bg-no-repeat bg-contain"
         style="background-image: url('/images/star.svg');">
    </div>
    <div class="absolute bottom-0 right-0 opacity-10 w-72 h-72 bg-no-repeat bg-contain"
         style="background-image: url('/images/dots.svg');">
    </div>

    <div class="relative max-w-7xl mx-auto z-10">
        <h1 class="text-center font-display text-3xl font-bold tracking-tight text-slate-900 md:text-4xl">🎊 Daftar Event</h1>

        <!-- Grid Responsive -->
        <div class="grid gap-8 sm:grid-cols-1 lg:grid-cols-3 p-3 md:p-4 xl:p-5 text-center">
            @forelse ($events as $event)
                <a href="{{ route('partisipan.event.form', $event->id) }}" class="group">
                    <div class="rounded-xl bg-white px-6 py-8 shadow-sm">
                        <!-- Gambar -->
                        <img 
                            src="https://source.unsplash.com/600x300/?conference,{{ $event->id }}" 
                            onerror="this.onerror=null; this.src='/images/default-event.jpg';"
                            alt="Event Image" 
                            class="mx-auto h-10 w-10"
                        >

                        <!-- Konten Card -->
                        <div class="p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <h2 class="my-3 text-black font-display font-medium">{{ $event->title }}</h2>
                                <p class="mt-1.5 text-black text-sm leading-6 text-secondary-500">{{ Str::limit($event->description, 100) }}</p>
                            </div>
                            <p class="mt-1.5 text-black text-sm leading-6 text-secondary-500">📅 {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</p>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center">
                    <p class="text-white text-lg">😔 Belum ada event yang tersedia.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
