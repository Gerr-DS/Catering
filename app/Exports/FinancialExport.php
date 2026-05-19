<?php

namespace App\Exports;

use App\Models\Financial;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FinancialExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Financial::select(
            'type',
            'amount',
            'description',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'Tipe',
            'Nominal',
            'Keterangan',
            'Tanggal'
        ];
    }
}