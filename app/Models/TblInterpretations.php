<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblInterpretations extends Model
{
    protected $table = 'tbl_interpretations';
    
    protected $fillable = ['surah_index','verse_index','info_interpretation_id','content',];

    protected $dates = ['created_at', 'updated_at'];

    public function info(){
        return $this->belongsTo(MasterInfoInterpretations::class, 'info_interpretation_id', 'id');
    }

    public function surah(){
        return $this->belongsTo(TblSurahs::class, 'surah_index', 'surah_index');
    }

    public function verse(){
        return $this->belongsTo(TblVerses::class, 'verse_index', 'verse_index');
    }
}