<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreSize extends Model {
    use HasFactory;

    protected $fillable = ['size', 'status'];

    protected $appends = ['text'];

    public function getTextAttribute() {
        return $this->size;
    }
}
