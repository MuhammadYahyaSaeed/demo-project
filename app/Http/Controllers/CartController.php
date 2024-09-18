<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $userId = Auth::id(); // Assuming users are authenticated
        $cart = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cart) {
            $cart->quantity++;
        } else {
            $cart = new Cart([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        $cart->save();

        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function index()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        return view('cart.index', compact('cartItems'));
    }

    public function update(Request $request)
    {
        $userId = Auth::id();
        $quantities = $request->input('quantity', []);

        foreach ($quantities as $cartId => $quantity) {
            if ($quantity <= 0) {
                Cart::where('id', $cartId)->where('user_id', $userId)->delete();
            } else {
                Cart::where('id', $cartId)->where('user_id', $userId)->update(['quantity' => $quantity]);
            }
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }

    public function remove($cartId)
    {
        $userId = Auth::id();
        Cart::where('id', $cartId)->where('user_id', $userId)->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }
}
