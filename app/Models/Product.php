<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['restaurant_id', 'name', 'picture', 'description', 'price', 'is_active'];

    // A product belongs to a restaurant
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
