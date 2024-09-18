<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    // Display a listing of the restaurants
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    // Show the form for creating a new restaurant
    public function create()
    {
        return view('restaurants.create');
    }

    // Store a newly created restaurant in storage
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'address' => 'required',
        //     'city' => 'required',
        //     'phone_no' => 'required|numeric|digits_between:10,15',
        //     'start_time' => 'required',
        //     'end_time' => 'required',
        //     'is_feature' => 'required',
        //     'is_active' => 'required',
        // ]);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone_no' => 'required|numeric|digits_between:10,15',
            'start_time' => 'required',
            'end_time' => 'required',
            'is_feature' => 'required',
            'is_active' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Restaurant::create($request->all());

        return redirect()->route('restaurants.index')->with('success', 'Restaurant created successfully.');
    }

    // Display the specified restaurant
    // public function show(Restaurant $restaurant)
    // {
    //     return view('restaurants.show', compact('restaurant'));
    // }

    // Show the form for editing the specified restaurant
    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', compact('restaurant'));
    }

    // Update the specified restaurant in storage
    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone_no' => 'required|numeric|digits_between:10,15',
            'start_time' => 'required',
            'end_time' => 'required',
            'is_feature' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $restaurant->update($request->all());

        return redirect()->route('restaurants.index')->with('success', 'Restaurant updated successfully.');
    }

    // Remove the specified restaurant from storage
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('restaurants.index')->with('success', 'Restaurant deleted successfully.');
    }


    public function show($id)
    {
        // Fetch the restaurant object by its ID
        $restaurant = Restaurant::findOrFail($id);

        // Pass the restaurant object to the view
        return view('restaurants.restaurant_details', compact('restaurant'));
    }
}
