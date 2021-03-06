<?php
namespace Database\Seeders;

use AdminTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // $this->call(UserSeeder::class);
        $this->call(AdminTableSeeder::class);
        // $this->call(SectionTableSeeder::class);
        // $this->call(CategoryTableSeeder::class);
        // $this->call(ProductTableSeeder::class);
        // $this->call(ProductAttributeTableSeeder::class);
        // $this->call(BrandTableSeeder::class);
        // $this->call(SliderTableSeeder::class);
        // $this->call(CouponTableSeeder::class);
        // $this->call(DeliveryAddressTableSeeder::class);
    }
}
