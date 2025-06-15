<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AverageGradesExport implements FromCollection, WithHeadings
{
    protected $averages;

    public function __construct($averages)
    {
        $this->averages = $averages;
    }

    public function collection()
    {
        return $this->averages->map(function($avg) {
            return [
                'subject_name' => $avg->subject->subject_name ?? 'Unknown',
                'average_grade' => number_format($avg->average_grade, 2),
            ];
        });
    }

    public function headings(): array
    {
        return ['Subject', 'Average Grade'];
    }
}
