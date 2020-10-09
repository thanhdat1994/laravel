<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class CustomerExport implements FromCollection, WithHeadings
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
        $customers = DB::table('customers', 'c')
            ->join('customer_classes', 'c.customer_class_id', '=', 'customer_classes.id')
            ->select('c.id','c.name', 'c.sex', 'c.birthday', 'c.address', 'c.phone', 'c.note', 'customer_classes.name as customer_class')
            ->get();
        foreach ($customers as $value) {
            $value->sex = ($value->sex == 1) ? 'Nữ' : 'Nam';
            $value->birthday = date('d/m/Y', strtotime($value->birthday));
        }
        return $customers;
    }
}
