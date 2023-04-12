<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblVerseAudios extends Model
{
    protected $table = 'tbl_verse_audios';
    
    protected $fillable = ['surah_index','verse_index','reciter_id','link',];

    protected $dates = ['created_at', 'updated_at'];

    public function reciter(){
        return $this->belongsTo(MasterReciters::class, 'reciter_id', 'id');
    }

    public function surah(){
        return $this->belongsTo(TblSurahs::class, 'surah_index', 'surah_index');
    }

    public function verse(){
        return $this->belongsTo(TblVerses::class, 'verse_index', 'verse_index');
    }
}
