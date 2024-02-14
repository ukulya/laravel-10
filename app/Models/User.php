<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'avatar'
    // ];

    // mass assignment
    // we can turn $fillable to guarded - oppposite of fillable
    protected $guarded = []; // we dont want to restrict any user inputs
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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

    protected function password():Attribute{
        return Attribute::make(
            set: fn($value) => bcrypt($value) // mutator
        );
    }
    protected function name(): Attribute
    {
        return Attribute::make(
            // get: fn ($value) => strtoupper($value), // Oakland -> OAKLAND - doesn't work 
            get: fn ($value) => Str::upper($value), // Oakland -> doesn't work 
        );
    }
}
