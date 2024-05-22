<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactGroupController;

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
Route::get('view_group', [ContactController::class, 'view_group'])->name('view_group');


Route::get('contact-group/create', [ContactGroupController::class, 'create'])->name('contact-group.create');
Route::post('contact-group', [ContactGroupController::class, 'store'])->name('contact-group.store');
Route::get('load-more-contacts', [ContactGroupController::class, 'loadMoreContacts'])->name('contact-group.load-more-contacts');


Route::get('/groups/create', [ContactGroupController::class, 'create_group'])->name('groups.create');
Route::post('/groups', [ContactGroupController::class, 'store_group'])->name('groups.store');