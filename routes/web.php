<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SubmitController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\PartisipanControler;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard admin (hanya untuk admin)
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('admin.dashboard');


Route::middleware('auth')->group(function() {
    Route::get('/admin/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/admin/partisipan/summary', [PartisipanControler::class, 'showSummary'])->name('partisipan.summary');
    Route::get('/admin/partisipan/{event}/participants', [PartisipanControler::class, 'showParticipants'])
    ->name('partisipan.participants.detail');
    Route::delete('/admin/participants/{submission}', [EventController::class, 'deleteParticipant'])->name('partisipan.participant.delete');
    Route::get('/admin/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/admin/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/admin/events/{id}', [EventController::class, 'show'])->name('events.show');
});


Route::get('/partisipan/home', [SubmitController::class, 'index'])->name('partisipan.home');
Route::get('partisipan/event/{event}', [SubmitController::class, 'form'])->name('partisipan.event.form');
Route::post('/partisipan/event/{event}/submit', [SubmitController::class, 'submit'])->name('partisipan.event.submit');
Route::get('/partisipan/event/{submission}/qrcode', [SubmitController::class, 'showQr'])->name('partisipan.event.qrcode');
Route::get('/absen/checkin/{token}', [AbsenController::class, 'checkin'])->name('absen.checkin');

