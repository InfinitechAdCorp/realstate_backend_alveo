<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility;
use App\Models\Property;

class FacilitySeeder extends Seeder
{
    public function run()
    {
        // Define properties with their respective facilities
        $propertiesWithFacilities = [
            'Anissa Heights' => [
                '24-hour Security',
                'Convenience Store',
                'Entertainment Room',
                'Grill Pits',
                'Jogging/Biking Path',
                'Laundry Station',
                'Main Entrance Gate',
                'Perimeter Fence',
                'Pool Shower Area',
                'Provision for CCTV Cameras',
                'Standby Electric Generator',
                'Water Station'
            ],
            'Allegra Garden Place' => [
                '24-hour Security',
                'Arrival Court',
                'Convenience Store',
                'Entertainment Room',
                'Fitness Gym',
                'Function Hall',
                'Game Room',
                'Gazebo/Cabana',
                'Grill Pits',
                'Landscaped Gardens',
                'Laundry Station',
                'Main Entrance Gate',
                'Open Lawn/Picnic Grove',
                'Perimeter Fence',
                'Pool Deck',
                'Pool Shower Area',
                'Pool Water Slides',
                'Provision for CCTV Cameras',
                'View Deck',
                'Standby Electric Generator',
                'Water Station',
                'WiFi Access',
                'Sky Promenade'
            ],
            'Fortis Residence' => [
                '24-hour Security',
                'Business Center',
                'Children\'s Playground',
                'Convenience Store',
                'Entertainment Room',
                'Fitness Gym',
                'Game Room',
                'Kiddie Pool',
                'Leisure Pool',
                'Main Entrance Gate',
                'Perimeter Fence',
                'WiFi Access'
            ],
            'Moncello Crest' => [
                '24-hour Security',
                'Arrival Court',
                'Business Center',
                'Entertainment Room',
                'Fitness Gym',
                'Game Room',
                'Gazebo/Cabana',
                'Jacuzzi',
                'Jogging/Biking Path',
                'Lounge Area',
                'Main Entrance Gate',
                'Open Lawn/Picnic Grove',
                'Perimeter Fence',
                'Provision for CCTV Cameras',
                'Spa',
                '100% Power back-up',
                'Golf cart inside the property',
                'High-speed internet in all common areas',
                'Multipurpose Court',
                'Restaurant Deck',
                'Convention Center',
                'Specialty Restaurant',
                'Main Dining Restaurant'
            ],
            'Mulberry Place' => [
                '24-hour Security',
                'Drop-Off Area',
                'Convenience Store',
                'AVR/Meeting Room',
                'Gazebo/Cabana',
                'Landscaped Gardens',
                'Laundry Station',
                'Open Lawn/Picnic Grove',
                'Perimeter Fence',
                'Pool Deck',
                'Pool Shower Area',
                'Provision for CCTV Cameras',
                'Standby Electric Generator',
                'Water Station',
                'WiFi Access'
            ],
            'Oak Harbor Residences' => [
                '24-hour Security',
                'Arrival Court',
                'Children\'s Playground',
                'Convenience Store',
                'Entertainment Room',
                'Game Area',
                'Gazebo/Cabana',
                'Jogging/Biking Path',
                'Landscaped Gardens',
                'Lap Pool',
                'Laundry Station',
                'Main Entrance Gate',
                'Open Lawn/Picnic Grove',
                'Perimeter Fence',
                'Pool Deck',
                'Pool Shower Area',
                'Pool Water Slides',
                'Provision for CCTV Cameras',
                'Standby Electric Generator',
                'View Deck',
                'WiFi Access'
            ],
            'One Delta Terraces' => [
                '24-hour Security',
                'Convenience Store',
                'Entertainment Room',
                'Fitness Gym',
                'Game Area',
                'Gazebo/Cabana',
                'Jogging/Biking Path',
                'Landscaped Gardens',
                'Laundry Station',
                'Leisure Pool',
                'Lounge Area',
                'Main Entrance Gate',
                'Open Lawn/Picnic Grove',
                'Pool Deck',
                'Pool Shower Area',
                'Pool Water Slides',
                'Provision for CCTV Cameras',
                'Sky Lounge',
                'Standby Electric Generator',
                'View Deck',
                'Water Station',
                'WiFi Access',
                'Landscaped Atriums'
            ],
            'Prisma Residence' => [
                '24-hour Security',
                'Drop-Off Area',
                'Basketball Court/Playcourt',
                'Convenience Store',
                'Audio-Visual Room',
                'Fitness Gym',
                'Function Hall',
                'Game Room',
                'Landscaped Gardens',
                'Laundry Station',
                'Open Lounge',
                'Perimeter Fence',
                'Palm Deck',
                'Pool Shower Area',
                'Provision for CCTV Cameras',
                'Sky Lounge',
                'Standby Electric Generator',
                'Observatory Deck',
                'Water Station',
                'WiFi Access'
            ],
            'Sage Residence' => [
                'Shooting Court',
                '24-hour Security',
                'Children\'s Play Area',
                'Convenience Store',
                'Coworking Space',
                'Game Area',
                'Gazebo/Cabana',
                'Grill Pits',
                'Jogging/Biking Path',
                'Landscaped Gardens',
                'Laundry Station',
                'Perimeter Fence',
                'Pool Shower Area',
                'Provision for CCTV Cameras',
                'Sky Park',
                'Standby Electric Generator',
                'Water Station',
                'WiFi Access'
            ],
            'Satory Residence' => [
                '24-hour Security',
                'Convenience Store',
                'Audio Visual Room',
                'Fitness Gym',
                'Multi-Purpose Area',
                'Game Area',
                'Gazebo/Cabana',
                'Grill Pits',
                'Landscaped Gardens',
                'Laundry Station',
                'Lounge Area',
                'Picnic/Grill Area',
                'Electrified Perimeter Fence',
                'Pool Deck',
                'Pool Shower Area',
                'Pool Water Slides',
                'Provision for CCTV Cameras',
                'Roof Deck',
                'Sky Lounge',
                'Standby Electric Generator',
                'Tree-lined Walkways/Garden',
                'Water Station'
            ],
            'Solmera Coast' => [
                'Roof Deck Pool',
                'Main Entrance Gate',
                'Pool Deck',
                '24-hour Security',
                'All-Day Dining Restaurant',
                'Basketball Court/Playcourt',
                'Children\'s Playground',
                'Entertainment Room',
                'Fitness Gym',
                'Game Room',
                'Gazebo/Cabana',
                'Jogging/Biking Path',
                'Leisure Pool',
                'Open Lawn/Picnic Grove',
                'Perimeter Fence',
                'Pool Shower Area',
                'Provision for CCTV Cameras',
                'Standby Electric Generator',
                'Golf Carts within the Property',
                'WiFi Access',
                'Alfresco',
                'Convention Center',
                'Specialty Restaurant',
                'Drop-Off Area'
            ],
            'Sonora Garden Residences' => [
                '24-hour Security',
                'Basketball Court/Playcourt',
                'Convenience Store',
                'Fitness Gym',
                'Function Hall',
                'Game Room',
                'Gazebo/Cabana',
                'Grill Pits',
                'Jogging/Biking Path',
                'Landscaped Atriums',
                'Landscaped Gardens',
                'Laundry Station',
                'Perimeter Fence',
                'Pool Deck',
                'Pool Shower Area',
                'Provision for CCTV Cameras',
                'Roof Deck',
                'Standby Electric Generator',
                'Water Station'
            ],
            'The Atherton' => [
                'Open Lawn/Picnic Grove',
                'Perimeter Fence',
                '24-hour Security',
                'Badminton Court',
                'Convenience Store',
                'Entertainment Room',
                'Fitness Gym',
                'Multi Purpose Area',
                'Game Area',
                'Gazebo/Cabana',
                'Jogging/Biking Path',
                'Kiddie Pool',
                'Laundry Station',
                'Lounge Area',
                'Pool Deck',
                'Pool Shower Area',
                'Provision for CCTV Cameras',
                'Roof Deck',
                'Sky Lounge',
                'Standby Electric Generator',
                'Water Station'
            ],
            'The Calinea Tower' => [
                '24-hour Security',
                'Convenience Store',
                'Entertainment Room',
                'Game Area',
                'Landscaped Gardens',
                'Laundry Station',
                'Open Lawn/Picnic Grove',
                'Perimeter Fence',
                'Pool Deck',
                'Pool Shower Area',
                'Provision for CCTV Cameras',
                'Sky Park',
                'Standby Electric Generator',
                'Water Station',
                'Internet in Units and Common Areas'
            ],
            'The Campden Place' => [
                // No facilities listed
            ],
            'The Crestmont' => [
                '24-hour Security',
                'Arrival Court',
                'Convenience Store',
                'Landscaped Gardens',
                'Laundry Station',
                'Main Entrance Gate',
                'Open Lawn/Picnic Grove',
                'Perimeter Fence',
                'Pool Deck',
                'Pool Shower Area',
                'Pool Water Slides',
                'Provision for CCTV Cameras',
                'Standby Electric Generator',
                'Water Station',
                'WiFi Access'
            ],
            'The Erin Heights' => [
                '24-hour Security',
                'Convenience Store',
                'Entertainment Room',
                'Fitness Gym',
                'Game Room',
                'Gazebo/Cabana',
                'Grill Pits',
                'Jogging/Biking Path',
                'Lap Pool',
                'Laundry Station',
                'Perimeter Fence',
                'Pool Deck',
                'Pool Shower Area',
                'Provision for CCTV Cameras',
                'Standby Electric Generator',
                'Water Station',
                'WiFi Access',
                'Amenity Core',
                'Coworking Space'
            ],
            'The Oriana' => [
                // No facilities available
            ],
            'The Valeron Tower' => [
                '24-hour Security',
                'Basketball Court/Playcourt',
                'Children\'s Playground',
                'Convenience Store',
                'Entertainment Room',
                'Fitness Gym',
                'Function Hall',
                'Game Area',
                'Gazebo/Cabana',
                'Grill Pits',
                'Jogging/Biking Path',
                'Landscaped Gardens',
                'Laundry Station',
                'Lounge Area',
                'Main Entrance Gate',
                'Open Lawn/Picnic Grove',
                'Perimeter Fence',
                'Pool Deck',
                'Pool Shower Area',
                'Provision for CCTV Cameras',
                'Roof Deck',
                'Standby Electric Generator',
                'Water Station',
                'WiFi Access',
                'Coworking Space',
            ],

        ];
        // Loop through properties and create facilities
        foreach ($propertiesWithFacilities as $propertyName => $facilities) {
            $property = Property::where('name', $propertyName)->first();

            if ($property) {
                foreach ($facilities as $facilityName) {
                    Facility::create(['property_id' => $property->id, 'name' => $facilityName]);
                }
            }
        }
    }
}