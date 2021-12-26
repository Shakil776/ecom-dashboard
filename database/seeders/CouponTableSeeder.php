<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Coupon;

class CouponTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $couponsRecords = [
            ['id'=>1, 'coupon_option'=>'Manual', 'coupon_code'=>'test10', 'categories'=>'1,2', 'users'=> 'shakil@gmail.com, test@mail.com', 'coupon_type'=> 'Single', 'amount_type'=>'Percentage', 'amount'=>100, 'expiry_date'=>'2021-02-25', 'status'=>1]
        ];

        Coupon::insert($couponsRecords);
    }
}
