<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DevelopmentType;
class DevelopmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the development types to be seeded
        $developmentTypes = [
            ['name' => 'High Rise Condominium'],
            ['name' => 'Mid Rise Condominium'],
            ['name' => 'Leisure Residences'],
        ];

        // Insert development types into the database
        foreach ($developmentTypes as $type) {
            DevelopmentType::create($type);
        }
    }
}
