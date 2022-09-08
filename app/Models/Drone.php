<?php

namespace App\Models;

use App\Models\Track;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Drone extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}
