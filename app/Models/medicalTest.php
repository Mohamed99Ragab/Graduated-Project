<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicalTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lab_name',
        'type',
        'lab_date',
        'lab_file',
        'created_at',
        'updated_at'

    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }


}
