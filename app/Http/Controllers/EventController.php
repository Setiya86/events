<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventField;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('fields')->latest()->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string',
            'event_date' => 'required|date',
            'fields'     => 'required|array',
        ]);

        $event = Event::create([
            'title'       => $request->title,
            'description' => $request->description,
            'event_date'  => $request->event_date,
        ]);

        foreach ($request->fields as $field) {
            EventField::create([
                'event_id' => $event->id,
                'label'    => $field['label'],
                'type'     => $field['type'],
                'options'  => $field['options'] ?? null,
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Event created successfully');
    }

    public function show($id)
    {
        $event = Event::with('fields')->findOrFail($id);

        return view('admin.events.show', compact('event'));
    }
}
