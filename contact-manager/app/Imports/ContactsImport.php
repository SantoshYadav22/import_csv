<?php

// app/Imports/ContactsImport.php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;

class ContactsImport implements ToModel
{
    public function model(array $row)
    {
        return new Contact([
            'name' => $row[0],
            'email' => $row[1],
            'phone' => $row[2],
        ]);
    }
}