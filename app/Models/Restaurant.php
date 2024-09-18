<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = ['name', 'address', 'city', 'phone_no', 'start_time', 'end_time', 'is_feature', 'is_active'];

    // A restaurant can have many products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
