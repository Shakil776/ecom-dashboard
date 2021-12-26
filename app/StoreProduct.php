<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'brand_id', 'name', 'sku', 'image', 'cost_price', 'retail_price', 'year', 'description', 'status'];

    protected $with = ['category', 'brand', 'size_stocks.size'];

    // category
    public function category() {
        return $this->belongsTo(StoreCategory::class);
    }

    // brand
    public function brand() {
        return $this->belongsTo(StoreBrand::class);
    }

    // size stocks
    public function size_stocks() {
        return $this->hasMany(ProductSizeStock::class, 'product_id');
    }
}
