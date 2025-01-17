<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            ArchitecturalThemeSeeder::class,
            DevelopmentTypeSeeder::class,
            StatusSeeder::class,
            // LocationSeeder::class,
            RoomPlanner::class,
            // PropertySeeder::class,
            // FacilitySeeder::class,
            // BuildingSeeder::class,
            // BuildingFeaturesSeeder::class, 
            
            // Other seeders...
        ]);
    }
    

}
