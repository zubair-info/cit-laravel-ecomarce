<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProduct extends Model
{
    use HasFactory;
    protected $guarded = [];
    function rel_to_product()
    {
        return $this->BelongsTo(Product::class, 'product_id');
    }
    function rel_to_customer()
    {
        return $this->BelongsTo(CustomerLogin::class, 'user_id');
    }
}
