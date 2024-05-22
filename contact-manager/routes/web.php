<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



Route::resource('contacts', ContactController::class);

Route::post('contacts/import', [ContactController::class, 'import'])->name('contacts.import');
Route::get('contacts_export', [ContactController::class, 'export'])->name('contacts_export');
