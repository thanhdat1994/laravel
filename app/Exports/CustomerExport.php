<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;

class CustomerExport implements FromCollection
{
    public function headings(): array
    {
        return [
            'ID', 'Name', 'Sex', 'Birthday', 'Address', 'Phone', 'Note', 'Customer Class'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::all();
    }
}
