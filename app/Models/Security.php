<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function track()
    {
        return $this->hasMany(Track::class);
    }
}
