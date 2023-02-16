<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;


    protected $table = 'subjects';

    protected $fillable = [
        'name',
        'created_at',
        'updated_at'
    ];


    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function questions(){

        return $this->hasMany(Question::class,'subject_id');
    }


}
