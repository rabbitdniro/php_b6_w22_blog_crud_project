<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['name', 'user_id'];
    // Define the relationship with the User model
    // A category belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Post model
    // A category can have many posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
