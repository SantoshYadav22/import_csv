<?php

// app/Exports/ContactsExport.php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ContactsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Contact::all();
    }

    /**
     * Define the headings for the Excel sheet.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Created At',
            'Updated At',
        ];
    }
}
