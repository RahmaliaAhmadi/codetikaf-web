<?php

namespace App\Imports;

use App\Models\TblInterpretations;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TafsirImport implements ToModel,WithHeadingRow
{
    
    public function model(array $row)
    {
        return new TblInterpretations([
            'info_interpretation_id'    => $row['info_interpretation_id'],
            'surah_index'               => $row['surah_index'],
            'verse_index'               => $row['verse_index'],
            'content'                   => 'https://stag.admin-oneummah.id/images/tafsir/'.$row['content'],
        ]);
    }
  
}
