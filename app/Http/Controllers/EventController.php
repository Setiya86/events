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
        'category'   => 'required|string', 
        'event_date' => 'required|date',
        'poster'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'fields'     => 'required|array',
    ]);

    // Upload poster
    $posterPath = null;
    if ($request->hasFile('poster')) {
        $posterPath = $request->file('poster')->store('posters', 'public');
    }

    $event = Event::create([
        'title'       => $request->title,
        'category'    => $request->category,
        'description' => $request->description,
        'event_date'  => $request->event_date,
        'poster'      => $posterPath,
    ]);

    foreach ($request->fields as $field) {
        EventField::create([
            'event_id' => $event->id,
            'label'    => $field['label'],
            'type'     => $field['type'],
            'options'  => !empty($field['options']) ? explode(',', $field['options']) : null,
        ]);
    }

    return redirect()->route('admin.dashboard')->with('success', 'Event created successfully');
}


    public function show($id)
    {
        $event = Event::with('fields')->findOrFail($id);

        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        // Ambil field yang terkait dengan event ini
        $fields = $event->fields()->get();

        return view('admin.events.edit', [
            'event'  => $event,
            'fields' => $fields
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'      => 'required|string',
            'category'   => 'required|string', 
            'event_date' => 'required|date',
            'poster'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'fields'     => 'required|array',
        ]);

        $event = Event::with('fields')->findOrFail($id);

        // Upload poster jika ada
        $posterPath = $event->poster;
        if ($request->hasFile('poster')) {
            if ($posterPath && \Storage::disk('public')->exists($posterPath)) {
                \Storage::disk('public')->delete($posterPath);
            }
            $posterPath = $request->file('poster')->store('posters', 'public');
        }

        // Update data event
        $event->update([
            'title'       => $request->title,
            'category'    => $request->category,
            'description' => $request->description,
            'event_date'  => $request->event_date,
            'poster'      => $posterPath,
        ]);

        // Ambil semua ID field lama
        $oldFieldIds = $event->fields->pluck('id')->toArray();
        $newFieldIds = [];

        foreach ($request->fields as $field) {
            // Jika ada id => update field lama
            if (!empty($field['id']) && in_array($field['id'], $oldFieldIds)) {
                $eventField = EventField::find($field['id']);
                $eventField->update([
                    'label'    => $field['label'],
                    'type'     => $field['type'],
                    'options'  => !empty($field['options']) ? explode(',', $field['options']) : null,
                ]);
                $newFieldIds[] = $field['id'];
            }
            // Jika tidak ada id => tambah field baru
            else {
                $newField = EventField::create([
                    'event_id' => $event->id,
                    'label'    => $field['label'],
                    'type'     => $field['type'],
                    'options'  => !empty($field['options']) ? explode(',', $field['options']) : null,
                ]);
                $newFieldIds[] = $newField->id;
            }
        }

        // Hapus field yang tidak ada di request
        $fieldsToDelete = array_diff($oldFieldIds, $newFieldIds);
        if (!empty($fieldsToDelete)) {
            EventField::whereIn('id', $fieldsToDelete)->delete();
        }

        return redirect()->route('admin.dashboard')->with('success', 'Event updated successfully');
    }

    public function destroy($id)
    {
        $event = Event::with('fields')->findOrFail($id);

        if ($event->poster && \Storage::disk('public')->exists($event->poster)) {
            \Storage::disk('public')->delete($event->poster);
        }

        $event->fields()->delete();
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

}

