<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TblQuestionAnswers extends Model
{

    protected $table = 'tbl_question_answers';
    
    protected $fillable = ['question_id','content'];

    protected $dates = ['created_at', 'updated_at'];

    public function question(){
        return $this->belongsTo(TblQuestionAnswers::class, 'question_id', 'id');
    }
}
