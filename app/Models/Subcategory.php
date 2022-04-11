<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Subcategory extends Model
{
    use HasFactory;
    // soft delete use
    use SoftDeletes;
    // all file update guarded=[]/ $guarded=['id] =>id not update
    protected $guarded = ['id'];
    // protected $fillable = ['user_id', 'category_name'];


    // table colume single id then belongsTo / multiple id then Hasmany
    function rel_to_category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    function rel_to_user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
