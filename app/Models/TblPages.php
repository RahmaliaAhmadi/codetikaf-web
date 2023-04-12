<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblPages extends Model
{
    protected $table = 'tbl_pages';
    
    protected $fillable = ['verse_start_index','verse_end_index','surah_start_index','surah_end_index','page','image'];

    protected $dates = ['created_at', 'updated_at'];

    public function surahStart(){
        return $this->belongsTo(TblSurahs::class, 'surah_start_index', 'surah_index');
    }

    public function surahEnd(){
        return $this->belongsTo(TblSurahs::class, 'surah_end_index', 'surah_index');
    }

    public function verseStart(){
        return $this->belongsTo(TblVerses::class, 'verse_start_index', 'verse_index');
    }

    public function verseEnd(){
        return $this->belongsTo(TblVerses::class, 'verse_end_index', 'verse_index');
    }
}
