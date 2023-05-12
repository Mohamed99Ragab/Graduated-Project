<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Growth extends Model
{
    use HasFactory;

    protected $fillable = [
        'weight',
        'height',
        'user_id',
        'weight_status',
        'height_status',
        'measure_date',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'user_id',
        'created_at',
        'updated_at'
    ];



}
