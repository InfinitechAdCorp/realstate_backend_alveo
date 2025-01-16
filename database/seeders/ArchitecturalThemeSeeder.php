<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ArchitecturalTheme;
class ArchitecturalThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run(): void
    {
        // Define the architectural themes to be seeded
    $architecturalThemes = [
    ['name' => 'Modern Contemporary'],
    ['name' => 'Modern with Moroccan Inspiration'],
    ['name' => 'Modern Filipino'],
    ['name' => 'Asian Tropical Theme'],
    ['name' => 'Asian Contemporary'],
    ['name' => 'N/A'],
    ['name' => 'Modern Tropical'],
    ['name' => 'Neo-Asian Minimalist'],
    ['name' => 'Modern Artisanal'],
];


        // Insert architectural themes into the database
        foreach ($architecturalThemes as $theme) {
            ArchitecturalTheme::create($theme);
        }
    }
}
