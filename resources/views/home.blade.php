@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1>Welcome to FoodApp</h1>
        <p>Order your favorite meals with just a click!</p>
        <a href="{{ route('menu') }}" class="btn btn-primary">Browse Menu</a>
    </div>
</section>

<!-- Food Categories -->
<section class="food-category-section py-5">
    <div class="container">
        <h2 class="text-center">Popular Categories</h2>
        <div class="food-category">
            <div class="food-card">
                <img src="{{ asset('images/BBQ.avif') }}" alt="Pizza" class="img-fluid rounded">
                <h5>Pizza</h5>
            </div>
            <div class="food-card">
                <img src="https://yourimageurl.com/burger.jpg" alt="Burger" class="img-fluid rounded">
                <h5>Burger</h5>
            </div>
            <div class="food-card">
                <img src="https://yourimageurl.com/sushi.jpg" alt="Sushi" class="img-fluid rounded">
                <h5>Sushi</h5>
            </div>
            <div class="food-card">
                <img src="https://yourimageurl.com/pasta.jpg" alt="Pasta" class="img-fluid rounded">
                <h5>Pasta</h5>
            </div>
        </div>
    </div>
</section>

<!-- Featured Meals -->
<section class="featured-meals-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center">Featured Meals</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/savour.png') }}" class="card-img-top" alt="Meal 1">
                    <div class="card-body">
                        <h5 class="card-title">Deluxe Pizza</h5>
                        <p class="card-text">A delicious combination of cheese, pepperoni, and fresh veggies.</p>
                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://yourimageurl.com/meal2.jpg" class="card-img-top" alt="Meal 2">
                    <div class="card-body">
                        <h5 class="card-title">BBQ Burger</h5>
                        <p class="card-text">Juicy beef patty, BBQ sauce, and crispy bacon.</p>
                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://yourimageurl.com/meal3.jpg" class="card-img-top" alt="Meal 3">
                    <div class="card-body">
                        <h5 class="card-title">Sushi Platter</h5>
                        <p class="card-text">Fresh salmon, tuna, and avocado rolled to perfection.</p>
                        <a href="#" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
