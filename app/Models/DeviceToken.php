<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    use HasFactory;


    protected $fillable = [
        'token','user_id','created_at','updated_at'
    ];



    public function user(){

        return $this->belongsTo(User::class,'user_id');
    }









}