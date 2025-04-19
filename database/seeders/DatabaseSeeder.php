<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create 3 companies
        Company::factory(3)->create();

        // 2. Create 20 users & attach each to 1–3 random companies
        User::factory(20)->create()->each(function (User $user) {
            $companyIds = Company::inRandomOrder()
                ->take(rand(1, 3))
                ->pluck('id')
                ->toArray();
            $user->companies()->attach($companyIds);
        });

        // 3. Create 20 products (each auto‐assigned to a random company)
        Product::factory(20)->create();

        // 4. Create 30 orders (each will pull a random product & match its company_id)
        Order::factory(30)->create();
    }
}
