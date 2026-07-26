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
}