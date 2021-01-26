<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $table = 'vehicles';

    protected $primaryKey = 'id';

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function customers()
    {
        return $this->belongsToMany(User::class)
            ->using(UserVehicle::class)
            ->withPivot([
                'started_at',
                'ended_at',
            ]);
    }
}
