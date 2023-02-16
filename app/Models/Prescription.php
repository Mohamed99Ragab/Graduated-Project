<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'note',
        'date',
        'file',
        'created_at',
        'updated_at'

    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

}
