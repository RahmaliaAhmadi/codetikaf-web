<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class TemplateSurahExport implements WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'section_id',
            'surah_index',
            'name',
            'count_serve',
            'type',
            'lafadz',
            'translate_name',
            'use_bismillah'
        ];
    }
}
