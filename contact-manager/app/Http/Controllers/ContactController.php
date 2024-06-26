<?php
// app/Http/Controllers/ContactController.php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactGroup;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactsImport;
use App\Exports\ContactsExport;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUpdated;


class ContactController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
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
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|string|email|max:255|unique:contacts',
            'phone' => 'nullable|string|min:10|max:10|regex:/^[0-9]+$/',

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
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => 'required|string|email|max:255|unique:contacts,email,' . $contact->id,
            'phone' => 'nullable|string|min:10|max:10|regex:/^[0-9]+$/',

        ]);

        // $contact->update($request->all());
        // return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');

        $originalData = $contact->getOriginal();

        $contact->update($request->all());

        $changes = $this->getChanges($originalData, $contact->getChanges());

        // Send email notification
        Mail::to($contact->email)->send(new ContactUpdated($contact, $changes));

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

    public function view_group(Request $request){
        $groups = ContactGroup::all();
        
        return view('contacts.view_group', compact('groups'));

    }

    protected function getChanges($original, $changes)
    {
        $result = [];
        // print_r($original);
        
        foreach ($changes as $field => $newValue) {
            if (isset($original[$field])) {
                $result[$field] = [
                    'old' => $original[$field],
                    'new' => $newValue,
                ];
            } else {
                $result[$field] = [
                    'old' => 'N/A',
                    'new' => $newValue,
                ];
            }
        }
        return $result;
    }
}
