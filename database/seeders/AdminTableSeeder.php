<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $adminRecords = [
            [
                'id'       => 1,
                'name'     => 'Shakil',
                'type'     => 'admin',
                'mobile'   => '01815752377',
                'email'    => 'admin@admin.com',
                'password' => Hash::make('123456'),
                'image'    => '',
                'status'   => 0,
            ],
        ];

        DB::table('admins')->insert($adminRecords);
    }
}
