<?php

namespace App\Models;

use App\Events\Tracker;
use App\Models\Drone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Track extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function drone()
    {
        return $this->belongsTo(Drone::class);
    }

    public function code()
    {
        return $this->belongsTo(Code::class);
    }

    public function security()
    {
        return $this->belongsTo(Security::class);
    }
}
