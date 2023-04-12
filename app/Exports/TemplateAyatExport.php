<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class TemplateAyatExport implements WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'surah_id',
            'index_section',
            'verse_index',
            'content_indopak',
            'content_utsmani',
            'latin',
            'translation'
        ];
    }
}
