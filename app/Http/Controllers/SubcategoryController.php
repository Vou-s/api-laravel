<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    // GET /api/subcategories
    public function index()
    {
        return response()->json(Subcategory::with('category')->get());
    }

    // POST /api/subcategories
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory = Subcategory::create($validated);
        return response()->json($subcategory, 201);
    }

    // GET /api/subcategories/{id}
    public function show($id)
    {
        $subcategory = Subcategory::with('category')->findOrFail($id);
        return response()->json($subcategory);
    }

    // PUT/PATCH /api/subcategories/{id}
    public function update(Request $request, $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory->update($validated);
        return response()->json($subcategory);
    }

    // DELETE /api/subcategories/{id}
    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();

        return response()->json(['message' => 'Subcategory deleted successfully']);
    }
}
