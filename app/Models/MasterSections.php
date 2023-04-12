<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSections extends Model
{
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $softCascade = ['surah'];

    protected $table = 'master_sections';
    
      protected function table(){
        return $this->table; 
    }
    
    protected $fillable = ['section_index'];

    protected $dates = ['created_at', 'updated_at'];

    public function surah(){
        return $this->hasMany(TblSurahs::class, 'section_id', 'section_index');
    }
}
