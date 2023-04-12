<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class TafsirExport implements  WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'info_interpretation_id',
            'verse_index',
            'surah_index',
            'content'
        ];
    }
}
