<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return response()->json(['restaurants' => $restaurants]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $restaurant = Restaurant::create($validatedData);
        return response()->json(['restaurant' => $restaurant], 201);
    }


    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return response()->json(['restaurant' => $restaurant]);
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
        ]);

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($validatedData);
        return response()->json($restaurant);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();
        return response()->json(['message' => 'Deleted Successfully'], 204);
    }
}
