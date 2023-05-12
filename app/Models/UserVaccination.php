<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVaccination extends Model
{
    use HasFactory;

    protected $table = 'user_vaccination';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'vaccination_id',
        'status',
    ];
}
