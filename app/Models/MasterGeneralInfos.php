<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGeneralInfos extends Model
{
    protected function table(){
        return $this->table; 
    }

    protected $table = 'master_general_infos';
    
    protected $fillable = ['title','description','image','link','is_show'];

    protected $dates = ['created_at', 'updated_at'];

}