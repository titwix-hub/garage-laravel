<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserVehicle extends Pivot
{
    public $timestamps = false;

    protected $dates = [
        'started_at',
        'ended_at',
    ];
}
