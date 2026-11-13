<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'price',
        'cost',
        'seller_id',
        'category_id',
        'image',
    ];

    public function seller(): BelongsTo{
        return $this->belongsTo(Seller::class);
    }

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function order(): BelongsToMany{
        return $this->belongsToMany(Order::class,'orderitems');
    }
    
}
