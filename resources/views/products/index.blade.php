@extends('layouts.app')

@section('title', 'Products for ' . $restaurant->name)

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Products for {{ $restaurant->name }}</h1>
    
    <div class="mb-4">
        <a href="{{ route('restaurants.products.create', $restaurant->id) }}" class="btn btn-primary btn-lg">Add New Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Picture</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Is Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>
                        @if($product->picture)
                            <img src="{{ asset('images/' . $product->picture) }}" alt="{{ $product->name }}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ \Illuminate\Support\Str::limit($product->description, 50) }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>
                        <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-danger' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('restaurants.products.edit', [$restaurant->id, $product->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('restaurants.products.destroy', [$restaurant->id, $product->id]) }}" method="POST" style="display:inline-block;">
                            
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">No products found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
