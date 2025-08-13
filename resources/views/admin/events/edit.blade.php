@extends('admin.layouts.app')

@section('title', 'Edit Event: ' . $event->title)
@section('bodyClass', 'min-h-screen')

@section('content')
<div class="max-w-3xl mx-auto p-6  overflow-y-auto">
    <h2 class="text-2xl font-bold mb-4">Edit Event</h2>
    @include('admin.events.partials.editform')
</div>
@endsection
