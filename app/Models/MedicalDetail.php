<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'blood_type',
        'allergy',
        'chronic_disease',
        'skin_disease',
        'genetic_disease',
        'Is_medicine',
        'created_at',
        'updated_at'

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'medicine_file'
    ];


    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }


}
