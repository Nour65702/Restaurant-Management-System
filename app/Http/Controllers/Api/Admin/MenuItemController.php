<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
   
    public function index()
    {
        $items = MenuItem::all();
        return response()->json(['items' => $items], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'rate' => 'nullable|numeric',
            'on_sale' => 'required|boolean',
        ]);

        $menuItem = MenuItem::create($validatedData);

        return response()->json(['item' => $menuItem], 201);
    }

    public function show(MenuItem $menuItem)
    {
        return response()->json(['item' => $menuItem]);
    }


    public function update(Request $request, MenuItem $menuItem)
    {
        $validatedData = $request->validate([
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'rate' => 'nullable|numeric',
            'on_sale' => 'nullable|boolean',
        ]);

        $menuItem->update($validatedData);

        return response()->json(['item' => $menuItem], 200);
    }


    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return response()->json(['message' => 'Deleted Succefully'], 204);
    }
}
