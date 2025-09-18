<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        // Eager load subcategories supaya frontend dapat langsung
        $categories = Category::with('subcategories')->get();
        return response()->json(['data' => $categories]);
    }

    public function subcategories($id)
    {
        $category = Category::with('subcategories')->findOrFail($id);
        return response()->json(['data' => $category->subcategories]);
    }
}
