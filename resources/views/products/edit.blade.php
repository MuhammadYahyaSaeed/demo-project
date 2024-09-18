@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="container mt-5">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h1 class="mb-4">Edit Product for {{ $restaurant->name }}</h1>

    <form action="{{ route('restaurants.products.update', [$restaurant->id, $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" required>{{ $product->description }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $product->price }}" required>
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="picture" class="form-label">Product Picture</label>
            <input type="file" name="picture" class="form-control">
            @if($product->picture)
                <img src="{{ asset('images/' . $product->picture) }}" alt="{{ $product->name }}" style="width: 150px; height: 150px; object-fit: cover;" class="mt-2">
            @endif
            @error('picture')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" {{ $product->is_active ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Is Active</label>
        </div>

        <button type="submit" class="btn btn-success">Update Product</button>
        <a href="{{ route('restaurants.products.index', $restaurant->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
