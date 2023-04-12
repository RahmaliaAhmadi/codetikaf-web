<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;

class TemplateAudioExport implements WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'surah_index',
            'verse_index',
            'reciter_id',
            'link'
        ];
    }
}
