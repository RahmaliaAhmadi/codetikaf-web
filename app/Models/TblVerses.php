<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblVerses extends Model
{
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $softCascade = ['audio','page_start','page_end','tafsir'];

    protected $table = 'tbl_verses';
    
    protected $fillable = ['surah_id','index_section','verse_index','content_indopak','content_utsmani','latin','translation'];

    protected $dates = ['created_at', 'updated_at'];

    public function surah(){
        return $this->belongsTo(TblSurahs::class, 'surah_id', 'surah_index');
    }

    public function section(){
        return $this->belongsTo(MasterSections::class, 'index_section', 'section_index');
    }
    public function audio(){
        return $this->hasMany(TblVerseAudios::class, 'verse_index', 'verse_index');
    }

    public function page_start(){
        return $this->hasMany(TblPages::class, 'verse_start_index', 'verse_index');
    }

    public function page_end(){
        return $this->hasMany(TblPages::class, 'verse_end_index', 'verse_index');
    }

    public function tafsir(){
        return $this->hasMany(TblInterpretations::class, 'verse_index', 'verse_index');
    }
}
