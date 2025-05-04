<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // This method will be used to display all categories
        // Fetch all categories from the database
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method will be used to show the form for creating a new category
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // This method will be used to store a new category in the database
        // Validate the request data
        $request->validate([
            'name' => 'required|string|min:5|unique:categories,name,',
            'user_id' => 'required|exists:users,id'
        ]);
        // Create a new category
        Category::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
        ]);
        // Redirect to the categories index page
        // return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        return redirect()->route('categories.index');
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
        // This method will be used to show the form for editing a category
        // Fetch the category from the database
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // This method will be used to update a category in the database
        // Validate the request data
        $request->validate([
            'name' => 'required|string|min:5|unique:categories,name,' . $id,
            'user_id' => 'required|exists:users,id'
        ]);
        // Fetch the category from the database
        $category = Category::findOrFail($id);
        // Update the category
        $category->update([
            'name' => $request->name,
            'user_id' => $request->user_id,
        ]);
        // Redirect to the categories index page
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        // return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // This method will be used to delete a category from the database
        // Fetch the category from the database
        $category = Category::findOrFail($id);
        // Delete the category
        $category->delete();
        // Redirect to the categories index page
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
