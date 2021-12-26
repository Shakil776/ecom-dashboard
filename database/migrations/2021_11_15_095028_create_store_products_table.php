<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('store_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('admins')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('store_categories')->onDelete('set null');
            $table->foreignId('brand_id')->nullable()->constrained('store_brands')->onDelete('set null');
            $table->string('name');
            $table->string('sku');
            $table->string('image')->nullable();
            $table->decimal('cost_price', 8, 2);
            $table->decimal('retail_price', 8, 2);
            $table->string('year', 4);
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('store_products');
    }
}
