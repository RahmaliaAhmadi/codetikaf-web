<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterLessonCategories extends Model
{
    use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

    protected $softCascade = ['lesson'];

    protected $table = 'master_lesson_categories';
    
    protected $fillable = ['name'];

    protected $dates = ['created_at', 'updated_at'];

    public function lesson(){
        return $this->hasMany(TblLessons::class, 'category_id', 'id');
    }
}
