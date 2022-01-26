<?php

namespace Database\Seeders;

use App\Models\ShopVisit;
use Illuminate\Database\Seeder;

class ShopVisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShopVisit::factory()
            ->count(1000)
            ->create();
    }
}
