<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Event;
use App\Models\EventSubmission;
use App\Models\EventSubmissionAnswer;

class SubmitController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('partisipan.home', compact('events'));
    }

    public function form(Event $event)
    {
        $event->load('fields');
        return view('partisipan.event.form', compact('event'));
    }

    public function submit(Request $request, Event $event)
    {
        // Buat aturan validasi dari field dinamis
        $rules = [];
        foreach ($event->fields as $field) {
            $rules[$field->label] = $field->required ? 'required|string' : 'nullable|string';
        }

        $validated = $request->validate($rules);

        // Simpan submission
        $submission = $event->submissions()->create([
            'submitted_at' => now(),
            'token' => Str::uuid(),
            'is_present' => false
        ]);

        // Simpan setiap jawaban partisipan
        // dd($validated, $event->fields);
        foreach ($event->fields as $field) {
            $inputName = $field->label;
            $inputValue = $validated[$inputName] ?? '<<kosong>>';
            logger("Menyimpan field: $inputName => $inputValue");

            EventSubmissionAnswer::create([
                'submission_id' => $submission->id,
                'field_id' => $field->id,
                'value' => $validated[$field->label] ?? ''
            ]);
        }

        return redirect()->route('partisipan.event.qrcode', ['submission' => $submission->id]);
    }

    // public function showQr(EventSubmission $submission)
    // {
    //     $qr = QrCode::size(300)->generate(route('absen.checkin', ['token' => $submission->token]));
    //     return view('partisipan.event.qrcode', compact('submission', 'qr'));
    // }

    public function showQr(EventSubmission $submission)
    {
        $checkinUrl = config('app.url') . route('absen.checkin', ['token' => $submission->token], false);

        $qr = \QrCode::size(300)->generate($checkinUrl);
        return view('partisipan.event.qrcode', compact('submission', 'qr'));
    }

}
