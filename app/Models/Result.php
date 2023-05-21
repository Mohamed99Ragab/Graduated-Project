<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;


    protected $table = 'results';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'question_id',
        'tip_id',
        'status'
    ];

    public function questions(){

        return $this->belongsTo(Question::class,'question_id');
    }

    public function tip(){

        return $this->belongsTo(Tips::class,'tip_id');
    }



}
