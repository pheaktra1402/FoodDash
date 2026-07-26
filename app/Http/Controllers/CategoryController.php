<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // 1. Show List of Categories
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    // 2. Show Create Category Form
    public function create()
    {
        return view('admin.categories.create');
    }

    // 3. Save Category to Database
    public function store(Request $request)
    {
        $request->validate([
            'category_code' => 'required|string|max:255|unique:categories,category_code',
            'category_name' => 'required|string|max:255|unique:categories,category_name',
            'description' =>'required|string|max:255',
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'category_code' => $request->category_code,
            'description' => $request->description
        ]);

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category created successfully!');
    }
    // Show the form to edit the category
public function edit($id)
{
    $category = Category::findOrFail($id);
    return view('admin.categories.edit', compact('category'));
}

// Update the category in the database
public function update(Request $request, $id)
{
    $request->validate([
        'name'        => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $category = Category::findOrFail($id);
    
    // Fallback support for name / category_name attribute
    $category->update([
        'name'        => $request->name,
        'description' => $request->description,
    ]);

    return redirect()->route('admin.categories.index')
                     ->with('success', 'Category updated successfully!');
}
}