<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSizeStocksTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('product_size_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('store_products')->onDelete('cascade');
            $table->foreignId('size_id')->nullable()->constrained('store_sizes')->onDelete('set null');
            $table->string('location');
            $table->string('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('product_size_stocks');
    }
}
