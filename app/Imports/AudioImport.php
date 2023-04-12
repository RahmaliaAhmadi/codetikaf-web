<?php

namespace App\Imports;

use App\Models\TblVerseAudios;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AudioImport implements ToModel,WithHeadingRow
{
   
    public function model(array $row)
    {
        return new TblVerseAudios([
            'surah_index'           => $row['surah_index'],
            'verse_index'           => $row['verse_index'],
            'reciter_id'         => $row['reciter_id'],
            'link'               => $row['link'],
        ]);
    }
  
}
