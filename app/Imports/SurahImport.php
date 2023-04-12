<?php

namespace App\Imports;

use App\Models\TblSurahs;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SurahImport implements ToModel,WithHeadingRow
{
  
    public function model(array $row)
    {
        return new TblSurahs([
            'section_id'         => $row['section_id'],
            'surah_index'        => $row['surah_index'],
            'name'               => $row['name'],
            'count_serve'        => $row['count_serve'],
            'type'               => $row['type'],
            'lafadz'             => $row['lafadz'],
            'translate_name'     => $row['translate_name'],
            'use_bismillah'      => $row['use_bismillah'],
            'image'             => 'https://stag.admin-oneummah.id/images/surah/'.$row['image'],
        ]);
    }
  
}

