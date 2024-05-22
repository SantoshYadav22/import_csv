<?php
// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactsImport;
use App\Exports\ContactsExport;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $contacts = Contact::query();

        if ($request->has('sort_by')) {
            $contacts->orderBy($request->get('sort_by'), $request->get('sort_direction', 'asc'));
        }

        $contacts = $contacts->paginate(10);
        return view('contacts.index', compact('contacts'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:contacts',
            'phone' => 'nullable|string|max:20'
        ]);

        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:contacts,email,' . $contact->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,csv']);

        Excel::import(new ContactsImport, $request->file('file'));

        return back()->with('success', 'Contacts imported successfully.');
    }

    public function export()
    {
        return Excel::download(new ContactsExport, 'contacts.xlsx');
    }
}
