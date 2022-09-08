<?php

namespace App\Models;

use App\Models\Track;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Code extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function track()
    {
        return $this->hasMany(Track::class);
    }
}
