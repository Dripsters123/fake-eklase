<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Grade;

class GradesExport implements FromCollection
{
    protected $grades;

    public function __construct($grades)
    {
        $this->grades = $grades;
    }

    public function collection()
    {
        return $this->grades;
    }
}
