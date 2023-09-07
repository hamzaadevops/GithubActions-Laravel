<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Spatie\Permission\Models\Role::insert([
            [
                "name" => "admin", "guard_name" => "web"
            ],
            [
                "name" => "agent", "guard_name" => "web"
            ],
            [
                "name" => "landlord", "guard_name" => "web"
            ],
            [
                "name" => "customer", "guard_name" => "web"
            ],
        ]);
    }
}
