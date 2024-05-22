<?php

// app/Imports/ContactsImport.php
namespace App\Imports;

use App\Models\Contact;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows->skip(1) as $row) {
            $existingContact = Contact::where('email', $row['email'])->first();

            if ($existingContact) {
                return null;
            }

            Contact::create([
                'name'     => $row['name'],
                'email'    => $row['email'],
                'phone'    => $row['phone'],
                // 'user_id'  => auth()->id(),
            ]);
        }
    }
}
