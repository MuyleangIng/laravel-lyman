<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    // public function causes()
    // {
    //     return $this->hasMany(Cause::class);
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider_name',
        'provider_id',
        'email_verified_at',
        'photo'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function setProviderTokenAttribute($value){
        return $this->attributes['provider_token'] = Crypt::crypt($value);
    }

    public function getProviderTokenAttribute($value)
    {
        return Crypt::decrypt($value);
    }

    public function causes()
    {
        return $this->hasMany(Cause::class, 'user_id');
    }

    public function causeReports()
    {
        return $this->hasMany(CauseReport::class);
    }

    public function likedCauses()
    {
        return $this->belongsToMany(Cause::class, 'cause_user_likes')->withTimestamps();
    }


    public function bookmarkedCauses()
    {
        return $this->belongsToMany(Cause::class, 'cause_user_bookmarks')->withTimestamps();
    }   

    public function volunteer()
    {
        return $this->hasOne(Volunteer::class);
    }

}
