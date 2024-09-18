<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    // Display a listing of the products  a specific restaurant
    public function index(Restaurant $restaurant)
    {
        $products = $restaurant->products;
        return view('products.index', compact('products', 'restaurant'));
    }

    // Show the form for creating a new product under a restaurant
    public function create(Restaurant $restaurant)
    {
        return view('products.create', compact('restaurant'));
    }

    // Store a  created product in storage under a restaurant
    public function store(Request $request, Restaurant $restaurant)
    {


        $validator = validator::make($request->all(), [

            'name' => 'required',
            'picture' => 'nullable|image|max:2048',
            'description' => 'required',
            'price' => 'required|numeric',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }




        // $request->validate([
        //     'name' => 'required',
        //     'picture' => 'nullable|image|max:2048',
        //     'description' => 'required',
        //     'price' => 'required|numeric',
        //     'is_active' => 'boolean'
        // ]);


        $pictureName = null;
        if ($request->hasFile('picture')) {
            $pictureName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('images'), $pictureName);
        }

        $restaurant->products()->create([
            'name' => $request->name,
            'picture' => $pictureName,
            'description' => $request->description,
            'price' => $request->price,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('restaurants.products.index', $restaurant)->with('success', 'Product created successfully.');
    }

    //  the specified product under a restaurant
    public function show(Restaurant $restaurant, Product $product)
    {
        return view('products.show', compact('product', 'restaurant'));
    }

    // the form for editing the specified product under a restaurant
    public function edit(Restaurant $restaurant, Product $product)
    {
        return view('products.edit', compact('product', 'restaurant'));
    }

    // Update the specified product in storage
    public function update(Request $request, Restaurant $restaurant, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'picture' => 'nullable|image|max:2048',
            'description' => 'required',
            'price' => 'required|numeric',
            'is_active' => 'boolean'
        ]);

        // Handle file upload for picture
        if ($request->hasFile('picture')) {
            $pictureName = time() . '.' . $request->picture->extension();
            $request->picture->move(public_path('images'), $pictureName);
            $product->picture = $pictureName;
        }

        $product->update($request->only(['name', 'description', 'price', 'is_active']));

        return redirect()->route('restaurants.products.index', $restaurant)->with('success', 'Product updated successfully.');
    }

    // Remove the specified product from storage
    public function destroy(Restaurant $restaurant, Product $product)
    {
        $product->delete();
        return redirect()->route('restaurants.products.index', $restaurant)->with('success', 'Product deleted successfully.');
    }
    public function addToCart(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart.');
    }
}
