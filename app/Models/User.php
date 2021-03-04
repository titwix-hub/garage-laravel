<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'wallet',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class)
            ->using(UserVehicle::class)
            ->withPivot([
                'started_at',
                'ended_at',
            ]);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function annonce()
    {
        return $this->hasMany(Annonce::class);
    }

    public function commentaire()
    {
        return $this->hasMany(Commentaire::class);
    }
}
