@extends('admin.layouts.app')

@section('title', 'Create Event')
@section('bodyClass', 'bg-gray-100 min-h-screen')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow rounded p-6">
    <h2 class="text-2xl font-bold mb-4">Create Event</h2>
    @include('admin.events.partials.form')
</div>
@endsection
