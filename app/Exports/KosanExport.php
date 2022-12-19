<?php

namespace App\Exports;

use App\Models\Kosan;
use Maatwebsite\Excel\Concerns\FromCollection;


class KosanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kosan::all();
    }
}
