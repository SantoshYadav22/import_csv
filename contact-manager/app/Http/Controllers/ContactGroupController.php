<?php

// app/Http/Controllers/ContactGroupController.php
namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Group;
use Illuminate\Http\Request;

class ContactGroupController extends Controller
{
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $contacts = Contact::paginate(500);
            return view('contact-group.partials.contacts', compact('contacts'))->render();
        }

        $contacts = Contact::paginate(500); // Load only 10 records at a time
        $groups = Group::all();
        
        return view('contact-group.create', compact('contacts', 'groups'));
    }

    // public function loadMoreContacts(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $contacts = Contact::paginate(10);
    //         return view('contact-group.partials.contacts', compact('contacts'))->render();
    //     }
    // }
    public function store(Request $request)
    {
        $request->validate([
            'contact_id' => 'required|exists:contacts,id',
            'group_ids' => 'required|array',
            'group_ids.*' => 'exists:groups,id',
        ]);

        $contact = Contact::findOrFail($request->contact_id);
        $contact->groups()->sync($request->group_ids);

        return redirect()->route('contact-group.create')->with('success', 'Groups assigned successfully.');
    }

    public function create_group()
    {
        return view('groups.create_group');
    }

    // Handle form submission
    public function store_group(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new group
        Group::create([
            'name' => $request->name,
        ]);

        // Redirect to a specific route or page
        return redirect()->route('groups.create')->with('success', 'Group created successfully.');
    }

}
