<!-- resources/views/restaurants/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Restaurant List</h1>
    <a href="{{ route('restaurants.create') }}" class="btn btn-success mb-3">Add New Restaurant</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Phone No</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Featured</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($restaurants as $restaurant)
                <tr>
                    <td>{{ $restaurant->name }}</td>
                    <td>{{ $restaurant->address }}</td>
                    <td>{{ $restaurant->city }}</td>
                    <td>{{ $restaurant->phone_no }}</td>
                    <td>{{ $restaurant->start_time }}</td>
                    <td>{{ $restaurant->end_time }}</td>
                    <td>{{ $restaurant->is_feature ? 'Yes' : 'No' }}</td>
                    <td>{{ $restaurant->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a href="{{ route('restaurants.show', $restaurant->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('restaurants.edit', $restaurant->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
