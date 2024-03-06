<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.category', compact('categories'));

    }

    public function store(Request $request)
    {

        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);
        $category = Category::create([
            'name' => $request->input('category_name'),
        ]);

        return redirect()->back()->with('success', 'Category added successfully.');
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        try {
            $category = Category::findOrFail($id);

            $category->name = $request->input('category_name');
            $category->save();

            return response()->json(['message' => 'Category updated successfully'], 200);
        } catch (\Exception $e) {
            // Return error response if something goes wrong
            return response()->json(['error' => 'Failed to update category'], 500);
        }
    }
}
