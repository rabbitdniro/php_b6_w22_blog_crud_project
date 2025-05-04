<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // This method will be used to display all posts
        // Fetch all posts from the database
        $posts = Post::where('user_id', Auth::user()->id)->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method will be used to show the form for creating a new post
        // We need to fetch authenticated user's categories to show in the form
        $categories = Category::where('user_id', Auth::user()->id)->get();
        // dd($categories);
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // This method will be used to store a new post in the database
        // Validate the request
        $request->validate([
            'post_title' => 'required|string|max:100|unique:posts,post_title',
            'post_content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',

        ]);

        // Handle the file upload for the featured image
        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $request->user_id . '_' . $image->getClientOriginalName();
            $imagePath = 'uploads/' . $imageName;
            $image->move(public_path('uploads'), $imageName);
        }

        // Store the post in the database
        Post::create([
            'post_title' => $request->post_title,
            'post_content' => $request->post_content,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'featured_image' => $imagePath,
        ]);

        // Redirect to the posts index page with a success message
        return redirect()->route('posts.index')->with('success', 'Post created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // This method will be used to show the form for editing a post
        // We need to fetch the post and the authenticated user's categories
        $post = Post::findOrFail($id);
        $categories = Category::where('user_id', Auth::user()->id)->get();
        // dd($categories);
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);

        // This method will be used to update a post in the database
        // Validate the request
        $request->validate([
            'post_title' => 'required|string|max:100|unique:posts,post_title,' . $post->id,
            'post_content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',

        ]);

        // Handle the file upload for the featured image
        // Check if the user has uploaded a new image
        // If not, we will keep the old image path

        if ($request->hasFile('featured_image')) {
            // Delete the old image if it exists
            if ($post->featured_image && file_exists(public_path($post->featured_image))) {
                // dd(public_path($post->featured_image));
                unlink(public_path($post->featured_image));
            }

            // Upload the new image
            $image = $request->file('featured_image');
            $imageName = time() . '_' . $request->user_id . '_' . $image->getClientOriginalName();
            $imagePath = 'uploads/' . $imageName;
            $image->move(public_path('uploads'), $imageName);
        }

        // Update the post in the database
        $post->update([
            'post_title' => $request->post_title,
            'post_content' => $request->post_content,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'featured_image' => $imagePath,
        ]);

        // Redirect to the posts index page with a success message
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // This method will be used to delete a post from the database
        $post = Post::findOrFail($id);
        // Check if the post has a featured image and delete it
        if ($post->featured_image && file_exists(public_path($post->featured_image))) {
            unlink(public_path($post->featured_image));
        }
        // Delete the post from the database
        $post->delete();
        // Redirect to the posts index page with a success message
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
