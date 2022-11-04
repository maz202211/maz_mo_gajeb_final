<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $filable = [
        'title', 'content', 'datte_written', 'feature_img',
        'vote_up', 'vote_down',
        'user_id', 'category_id', 'voters'
    ];
    use HasFactory;
    public function auther()
    {
        return $this->belongsTo(User::class, foreignKey: 'user_id', ownerKey: 'id');
    }
    public function comment()
    {
        return $this->hasMany(comment::class);
    }
    public function category()
    {
        return $this->belongsTo(category::class);
    }
}
