<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'gender',
        'photo',
        'birth_date',
        'oauth_token',
        'provider',
        'provider_id',
        'is_reminder_vaccine',
    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at',
        'oauth_token',
        'provider',
        'provider_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }


//    twillow sms get phone number that code is sent to it when rest password
    public function routeNotificationForTwilio()
    {
        return $this->phone_number;
    }

################### relationship between user and deviceTokens ##############

    public function getDeviceTokens(){

        return $this->hasMany(DeviceToken::class,'user_id');
    }




################ end relationship ###################################



    ############ firebase method to push notification ###########
    public function routeNotificationForFcm()
    {
        return $this->getDeviceTokens()->pluck('token')->toArray();
    }


############ end firebase method to push notification with this tokens ###########


    // medical details relationship
    public function medicalDetails(){

        return $this->hasOne(MedicalDetail::class,'user_id');
    }



    // medical tests relationship
    public function medicalTests(){

        return $this->hasMany(medicalTest::class,'user_id');
    }


    // Perscription relationship
    public function prescriptions(){

        return $this->hasMany(Prescription::class,'user_id');
    }


    // Teeth Development relationship
    public function teethDevelopments(){

        return $this->hasMany(TeethDevelopment::class,'user_id');
    }


    // Reminder Relationship
    public function reminders(){

        return $this->hasMany(MedicationReminder::class,'user_id');
    }

    public function userTimes(){

        return $this->hasManyThrough(MedicineTime::class,MedicationReminder::class,'user_id','medication_reminder_id');
    }

    public function medicinedays(){

        return $this->hasMany(MedicineDay::class,'user_id');
    }



    // Ai Diseases Relationship
    public function aiDiseases(){

        return $this->hasMany(AiDisease::class,'user_id');
    }



    // User Vaccinations Relationship
    public function vaccinations(){

        return $this->belongsToMany(Vaccination::class,'user_vaccination','user_id','vaccination_id');
    }











}
