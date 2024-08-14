<?php

namespace App\Exports;

use App\Models\Cause;
use Maatwebsite\Excel\Concerns\FromCollection;

class CausesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cause::all();
    }
}
