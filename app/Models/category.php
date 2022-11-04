<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{

    protected $filable = [
        'title'
    ];
    use HasFactory;
    public function posts()
    {
        return $this->hasMany(post::class);
    }
    public function comment()
    {
        return $this->hasMany(comment::class);
    }
}
