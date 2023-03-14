<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teeth extends Model
{
    use HasFactory;

    protected $table = 'teeths';

    protected $fillable = [
        'name',
        'month_start',
        'month_end'
    ];

    public $timestamps = false;


    public function teethsDevelops(){

        return $this->hasMany(TeethDevelopment::class,'teeth_id');
    }




}
