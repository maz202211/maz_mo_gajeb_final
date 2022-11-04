<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{

    protected $fillable = [
        'content', 'date_written',
        'user_id', 'post_id'
    ];
    use HasFactory;
}
