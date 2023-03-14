<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiDisease extends Model
{
    use HasFactory;

    protected $table = "ai_diseases";
    protected $fillable = [
        'user_id',
        'prediction',
        'disease_name',
        'disease_photo',
        'created_at',
        'updated_at'

    ];

    protected $hidden = [
        'updated_at'
    ];


    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }
}
