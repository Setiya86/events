<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\EventField;
use App\Models\EventSubmission;
use App\Models\EventSubmissionAnswer;

class PartisipanControler extends Controller
{
    public function showSummary()
    {
        $events = Event::withCount('submissions')->get();

        return view('admin.partisipan.summary', compact('events'));
    }

    public function showParticipants($eventId)
    {
        $event = Event::with('fields')->findOrFail($eventId);

        $submissions = $event->submissions()->with('answers')->get();

        return view('admin.partisipan.participants', compact('event', 'submissions'));
    }

    public function deleteParticipant($submissionId)
    {
        $submission = EventSubmission::findOrFail($submissionId);
        $eventId = $submission->event_id;

        // Hapus jawaban peserta
        $submission->answers()->delete();

        // Hapus submission peserta
        $submission->delete();

        return redirect()->route('partisipan.participants.detail', $eventId)
            ->with('success', 'Peserta berhasil dihapus');
    }
}
