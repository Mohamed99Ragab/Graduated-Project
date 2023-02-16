<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeethDevelopment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'apperance_date',
        'teeth_name',
        'age_in_years',
        'age_in_months',
        'age_in_days',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at'
    ];


    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }

}
