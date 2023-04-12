<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblContactUs extends Model
{

    protected $table = 'tbl_contact_us';
    
    protected $fillable = ['image','content'];

    protected $dates = ['created_at', 'updated_at'];

}
