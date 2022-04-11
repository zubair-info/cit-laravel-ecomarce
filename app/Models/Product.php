<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    function rel_to_inventory()
    {
        return $this->BelongsTo(Inventory::class, 'product_id');
    }
    // table colume single id then belongsTo / multiple id then Hasmany
    function rel_to_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
