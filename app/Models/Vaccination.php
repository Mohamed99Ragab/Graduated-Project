<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $table = 'vaccinations';

    protected $fillable = [
        'name',
        'vaccine_age',
        'number_syringe',
        'important',
        'about',
        'disease_prevention',
        'side_effects',
        'image',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [

        'created_at',
        'updated_at'
    ];


    public function users(){

        return $this->belongsToMany(User::class,'user_vaccination','vaccination_id','user_id');
    }




}
