<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterInfoInterpretations extends Model
{
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $softCascade = ['tafsir'];

    protected $table = 'master_info_interpretations';
    
    protected $fillable = ['name'];

    protected $dates = ['created_at', 'updated_at'];

    public function tafsir(){
        return $this->hasMany(TblInterpretations::class, 'info_interpretation_id', 'id');
    }
}
