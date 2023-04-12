<?php

namespace App\Imports;

use App\Models\TblVerses;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AyatImport implements ToModel,WithHeadingRow
{
   
    public function model(array $row)
    {
        return new TblVerses([
            'surah_id'           => $row['surah_id'],
            'index_section'      => $row['index_section'],
            'verse_index'              => $row['verse_index'],
            'content_indopak'    => $row['content_indopak'],
            'content_utsmani'    => $row['content_utsmani'],
            'latin'              => $row['latin'],
            'translation'        => $row['translation'],
        ]);
    }
  
}
