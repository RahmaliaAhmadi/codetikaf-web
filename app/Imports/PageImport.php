<?php

namespace App\Imports;

use App\Models\TblPages;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PageImport implements ToModel,WithHeadingRow
{
   
    public function model(array $row)
    {
        
        return new TblPages([
            'surah_start_index'     => $row['surah_start_index'],
            'verse_start_index'     => $row['verse_start_index'],
            'surah_end_index'       => $row['surah_end_index'],
            'verse_end_index'       => $row['verse_end_index'],
            'page'                  => $row['page'],
            'image'                 => 'https://stag.admin-oneummah.id/images/halaman/'.$row['image'],
        ]);
    }
  
}