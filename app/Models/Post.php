<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'post_title',
        'post_content',
        'featured_image',
        'user_id',
        'category_id',
    ];

    // Define the relationship with the Category model
    // A post belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Define the relationship with the User model
    // A post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
