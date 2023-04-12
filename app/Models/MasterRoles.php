<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRoles extends Model
{
    protected $table = 'master_roles';
    
    protected $fillable = ['name'];

    protected $dates = ['created_at', 'updated_at'];
}
