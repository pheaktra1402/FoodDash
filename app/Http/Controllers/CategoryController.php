<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'iconUrl' => 'nullable|url',
        ]);

        Category::create([
            'name' => $request->name,
            'iconUrl' => $request->iconUrl,
        ]);

        return back()->with('status', 'Category created successfully!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'iconUrl' => 'nullable|url',
        ]);

        $category->update([
            'name' => $request->name,
            'iconUrl' => $request->iconUrl,
        ]);

        return back()->with('status', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('status', 'Category deleted successfully!');
    }
}