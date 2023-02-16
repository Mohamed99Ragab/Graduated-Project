<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


    protected $table = 'questions';

    protected $fillable = [
        'question',
        'subject_id',
        'age_stage',
        'created_at',
        'updated_at'
    ];


    protected $hidden = [
        'subject_id',
        'created_at',
        'updated_at'
    ];


    public function subject(){


        return $this->belongsTo(Subject::class,'subject_id');
    }


    public function tips(){


        return $this->belongsToMany(Tips::class,'tips_question','question_id','tips_id');

    }


}
