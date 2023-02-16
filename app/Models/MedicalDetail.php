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
        'medicine_file',
        'created_at',
        'updated_at'

    ];


    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }


}
