<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class TemplatePageExport implements WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'surah_start_index',
            'verse_start_index',
            'surah_end_index',
            'verse_end_index',
            'page',
            'image'
        ];
    }
}