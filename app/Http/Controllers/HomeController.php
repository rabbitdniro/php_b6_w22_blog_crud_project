<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // This method returns the home view
    public function index()
    {
        $posts = Post::paginate(12); // Fetch posts with pagination
        return view('home', compact('posts'));
    }
}
