<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblTermConditions extends Model
{

    protected $table = 'tbl_term_conditions';
    
    protected $fillable = ['description'];

    protected $dates = ['created_at', 'updated_at'];

}
