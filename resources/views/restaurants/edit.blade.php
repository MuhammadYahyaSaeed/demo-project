<!DOCTYPE html>
<html>
<head>
    <title>Edit Restaurant - Food Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/3.0.0/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-8">
        <h1 class="text-2xl font-bold mb-6">Edit Restaurant</h1>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">There were some problems with your input.</span>
                <ul class="list-disc pl-5 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
`
        <!-- Edit Form -->
        <form action="{{ route('restaurants.update', $restaurant->id) }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $restaurant->name) }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-gray-700 font-semibold mb-2">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', $restaurant->address) }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="city" class="block text-gray-700 font-semibold mb-2">City</label>
                <input type="text" name="city" id="city" value="{{ old('city', $restaurant->city) }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="phone_no" class="block text-gray-700 font-semibold mb-2">Phone Number</label>
                <input type="text" name="phone_no" id="phone_no" value="{{ old('phone_no', $restaurant->phone_no) }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="start_time" class="block text-gray-700 font-semibold mb-2">Start Time</label>
                <input type="time" name="start_time" id="start_time" value="{{ old('start_time', $restaurant->start_time) }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="end_time" class="block text-gray-700 font-semibold mb-2">End Time</label>
                <input type="time" name="end_time" id="end_time" value="{{ old('end_time', $restaurant->end_time) }}" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="is_feature" class="flex items-center">
                    <input type="checkbox" name="is_feature" id="is_feature" {{ old('is_feature', $restaurant->is_feature) ? 'checked' : '' }} class="mr-2">
                    <span class="text-gray-700 font-semibold">Feature this restaurant</span>
                </label>
            </div>

            <div class="mb-4">
                <label for="is_active" class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', $restaurant->is_active) ? 'checked' : '' }} class="mr-2">
                    <span class="text-gray-700 font-semibold">Active</span>
                </label>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update Restaurant</button>
                <a href="{{ route('restaurants.index') }}" class="ml-4 text-blue-500 hover:text-blue-600">Back to List</a>
            </div>
        </form>
    </div>
</body>
</html>
