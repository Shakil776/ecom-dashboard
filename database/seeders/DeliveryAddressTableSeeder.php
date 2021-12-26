<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\DeliveryAddress;

class DeliveryAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliveryAddressRecords = [
            ['id'=>1, 'user_id'=>1, 'name'=>'Rasel Ahmed', 'address'=>'State Guest House', 'city'=> 'Dhaka', 'state'=> 'Dhaka', 'country'=>'Bangladesh', 'pincode'=>'103245', 'mobile'=>'01987876565', 'status'=>1],

            ['id'=>2, 'user_id'=>2, 'name'=>'Shakil Hossain', 'address'=>'Chairman Bari, House no 4', 'city'=> 'Dhaka', 'state'=> 'Dhaka', 'country'=>'Bangladesh', 'pincode'=>'1335245', 'mobile'=>'01756765650', 'status'=>1],

        ];

        DeliveryAddress::insert($deliveryAddressRecords);
    }
}
