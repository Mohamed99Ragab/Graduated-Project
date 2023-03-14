<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineDay extends Model
{
    use HasFactory;

    protected $table = 'medicine_days';

    public $timestamps =false;
    protected $fillable = [

        'day',

    ];

    protected $hidden = [
        'pivot',
    ];



    public function medicinetimes(){

        return $this->belongsToMany(MedicineTime::class,'medicine_time_day','medicine_day_id','medicine_time_id');
    }

}
