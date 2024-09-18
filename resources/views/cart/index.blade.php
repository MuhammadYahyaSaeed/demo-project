@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')

<div class="container">
    <h2 class="mb-4">Your Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($cartItems->count() > 0)
        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $cartItem)
                        <tr>
                            <td>{{ $cartItem->product->name }}</td>
                            <td>${{ number_format($cartItem->product->price, 2) }}</td>
                            <td>
                                <input type="number" name="quantity[{{ $cartItem->id }}]" value="{{ $cartItem->quantity }}" min="1" class="form-control" style="width: 100px;">
                            </td>
                            <td>${{ number_format($cartItem->product->price * $cartItem->quantity, 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td>Total: ${{ number_format($cartItems->sum(function($item) {
                            return $item->product->price * $item->quantity;
                        }), 2) }}</td>
                        <td>
                            <button type="submit" class="btn btn-primary">Update Cart</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </form>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>

@endsection
