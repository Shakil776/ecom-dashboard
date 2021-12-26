<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCategory extends Model {
    use HasFactory;

    protected $fillable = ['name', 'status'];

    protected $appends = ['text'];

    public function getTextAttribute() {
        return $this->name;
    }
}
