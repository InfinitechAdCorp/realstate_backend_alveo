<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property; // Make sure to import the Property model

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            [
                'key' => 'pasaycity',
                'name' => 'Anissa Heights',
                'status' => 'New',
                'location' => 'Pasay City',
                'lat' => 14.5333,
                'lng' => 120.9893,
                'specific_location' => 'P. Zamora St., Brgy. 101, San Roque District, Pasay City',
                'price_range' => 'PHP3,098,600 - PHP3,600,000',
                'units' => 'N/A',
                'land_area' => '4,000 sqm.',
                'development_type' => 'High Rise Condominiums',
                'architectural_theme' => 'Modern Contemporary',
                'path' => 'assets/Location/Residences View/Anissa Heights View.jpg',
                'view' => 'assets/Location/Residences View/Anissa Heights Master Plan.jpg',
                'features' => json_encode([
                    ['name' => 'Childrens Playground', 'image' => 'assets/Location/Anissa Heights/Childrens Playground.jpg'],
                    ['name' => 'Drop-Off Area', 'image' => 'assets/Location/Anissa Heights/Drop-Off Area.jpg'],
                    ['name' => 'Fitness Gym', 'image' => 'assets/Location/Anissa Heights/Fitness Gym.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets/Location/Anissa Heights/Kiddie Pool.jpg'],
                    ['name' => 'Landscaped Gardens', 'image' => 'assets/Location/Anissa Heights/Landscaped Gardens.jpg'],
                    ['name' => 'Leisure Pool', 'image' => 'assets/Location/Anissa Heights/Leisure Pool.jpg'],
                    ['name' => 'Lounge Area', 'image' => 'assets/Location/Anissa Heights/Lounge Area.jpg'],
                    ['name' => 'Pool Deck', 'image' => 'assets/Location/Anissa Heights/Pool Deck.jpg'],
                    ['name' => 'Shooting Court', 'image' => 'assets/Location/Anissa Heights/Shooting Court.jpg'],
                    ['name' => 'Sky Lounge', 'image' => 'assets/Location/Anissa Heights/Sky Lounge.jpg'],
                    ['name' => 'Sky Promenade', 'image' => 'assets/Location/Anissa Heights/Sky Promenade.jpg'],
                    ['name' => 'Passenger Elevator', 'image' => 'assets/Location/Anissa Heights/Building/Building Feature - Passenger Elevators.jpg'],
                    ['name' => 'Reception Lobby', 'image' => 'assets/Location/Anissa Heights/Building/Building Feature - Reception Lobby.jpg'],
                ])
            ]
        ];

        foreach ($properties as $propertyData) {
            Property::updateOrCreate(
                ['name' => $propertyData['name']], // Check for existing property by name
                $propertyData // Create or update with these attributes
            );
        }
    }
}
