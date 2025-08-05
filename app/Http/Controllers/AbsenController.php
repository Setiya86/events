<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventSubmission;

class AbsenController extends Controller
{
    public function checkin($token)
    {
        $submission = EventSubmission::where('token', $token)->firstOrFail();

        if ($submission->is_present) {
            return view('absen.already_checked_in');

        }

        $submission->update(['is_present' => true]);

        return view('absen.success', compact('submission'));
    }
}
