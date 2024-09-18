@extends('layouts.app')

@section('title', 'Add New Product')

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
    <h1 class="mb-4">Add New Product for {{ $restaurant->name }}</h1>

    <form action="{{ route('restaurants.products.store', $restaurant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ old('price') }}" required>
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="picture" class="form-label">Product Picture</label>
            <input type="file" name="picture" class="form-control">
            @error('picture')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" class="form-check-input" {{ old('is_active') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Is Active</label>
        </div>

        <button type="submit" class="btn btn-success">Add Product</button>
        <a href="{{ route('restaurants.products.index', $restaurant->id) }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
