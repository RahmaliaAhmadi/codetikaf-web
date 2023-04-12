<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblLessons extends Model
{
    protected $table = 'tbl_lessons';
    
    protected function table(){
        return $this->table; 
    }
    
    protected $fillable = ['category_id','title','speaker','description','poster','url_video','is_recommended'];

    protected $dates = ['created_at', 'updated_at'];

    public function category(){
        return $this->belongsTo(MasterLessonCategories::class, 'category_id', 'id');
    }

}
