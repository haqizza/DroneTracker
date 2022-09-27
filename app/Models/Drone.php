<?php

namespace App\Models;

use App\Models\Track;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Drone extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'merk',
        'image',
        'mode_id',
        'description'
    ];

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}
