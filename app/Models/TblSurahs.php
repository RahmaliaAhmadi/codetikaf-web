<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblSurahs extends Model
{
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $softCascade = ['ayat'];

    protected $table = 'tbl_surahs';
    
    protected $fillable = ['section_id','surah_index','name','count_serve','type','lafadz','translate_name','use_bismillah','image'];

    protected $dates = ['created_at', 'updated_at'];

    public function section(){
        return $this->belongsTo(MasterSections::class, 'section_id', 'section_index');
    }

    public function ayat(){
        return $this->hasMany(TblVerses::class, 'surah_id', 'surah_index');
    }
}