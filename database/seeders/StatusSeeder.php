<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;
class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        // Seed the 'status' table with predefined values
        $statuses = [
            ['name' => 'New'],
            ['name' => 'Under Construction'],
            ['name' => 'Ready For Occupancy'],
        ];

        // Insert statuses into the database
        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
