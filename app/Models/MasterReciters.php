<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterReciters extends Model
{
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $softCascade = ['audio'];

    protected $table = 'master_reciters';
    
    protected $fillable = ['name'];

    protected $dates = ['created_at', 'updated_at'];

    public function audio(){
        return $this->hasMany(TblVerseAudios::class, 'reciter_id', 'id');
    }
}
