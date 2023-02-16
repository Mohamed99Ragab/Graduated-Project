<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineTime extends Model
{
    use HasFactory;

    protected $table = 'medicine_times';

    protected $fillable = [
        'quantity',
        'time',
        'medication_reminder_id',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'medication_reminder_id',
        'created_at',
        'updated_at'
    ];


    public function reminder(){

        return $this->belongsTo(MedicationReminder::class,'medication_reminder_id');
    }








    ////////// Mutators //////////////
    public function setCreatedAtAttribute($date)
    {
        $this->attributes['created_at'] = date_format($date,'Y-m-d h:i:s');
    }

    public function setUpdatedAtAttribute($date)
    {
        $this->attributes['updated_at'] = date_format($date,'Y-m-d h:i:s');
    }



}
