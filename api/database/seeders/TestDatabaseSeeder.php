<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ShopSeeder::class);
        $this->call(ShopVisitSeeder::class);
        $this->call(FakeUserSeeder::class);
    }
}
