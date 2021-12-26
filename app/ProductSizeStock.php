<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeStock extends Model {
    use HasFactory;

    // brand
    public function size() {
        return $this->belongsTo(StoreSize::class);
    }
}
