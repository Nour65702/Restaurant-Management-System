<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['menuItems'])->get();
        return response()->json(['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => 'required|string|max:255',
        ]);

        $category = Category::create($validatedData);
        return response()->json(['category' => $category], 201);
    }

    // Display the specified resource.
    public function show($id)
    {
        $category = Category::with(['menuItems'])->findOrFail($id);
        return response()->json(['category' => $category]);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'restaurant_id' => 'sometimes|required|exists:restaurants,id',
            'name' => 'sometimes|required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validatedData);
        return response()->json(['category' => $category]);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['message' => 'Deleted Successfully'], 204);
    }
}
