<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationReminder extends Model
{
    use HasFactory;

    protected $table = 'medication_reminders';

    protected $fillable = [
        'user_id',
        'medicine_name',
        'appointment',
        'start_date',
        'end_date',
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

    public function medcineTimes(){

        return $this->hasMany(MedicineTime::class,'medication_reminder_id');
    }








}
