<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tips extends Model
{
    use HasFactory;


    protected $table = 'tips';

    protected $fillable = [
        'description',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function questions(){


        return $this->belongsToMany(Question::class,'tips_question','tips_id','question_id');

    }

}
