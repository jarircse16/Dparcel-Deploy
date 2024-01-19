<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com', //
            'password' => Hash::make('admin1234'),
        ]);

        DB::table('riders')->insert([
            'rider_name' => 'Rider',
            'email' => 'rider@gmail.com', //
            'password' => Hash::make('rider1234'),
        ]);

        DB::table('vendors')->insert([
            'vendor_name' => 'Vendor', //
            'email' => 'vendor@gmail.com',
            'password' => Hash::make('vendor1234'),
        ]);
    }


}
