<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable implements JWTSubject
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name','phone','email','district_id','thana_id','address','country_id','area_id','profile_picture','thub_picture','username','password','status','save_by','updated_by'];



// jwt
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function district(){
        return $this->belongsTo(District::class);
    }
    public function thana(){
        return $this->belongsTo(Thana::class);
    }
    public function area(){
        return $this->belongsTo(Area::class,'area_id','id');
    }

}