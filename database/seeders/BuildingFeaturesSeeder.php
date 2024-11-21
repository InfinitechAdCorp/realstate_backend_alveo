<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Property;
class BuildingFeaturesSeeder extends Seeder
{
    public function run()
    {
        // Define buildings and their features in a single array
        $buildings = [
            'Anissa Heights' => [
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Cabinets',
                'Fire Exit',
                'Garbage Rooms',
                'Sky Patio (Lumiventt Technology)',
                'Mailbox Area',
                'Parking Space',
                'Provision for CCTV',
            ],
            'Allegra Garden Place' => [
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Cabinets',
                'Fire Exit',
                'Garbage Rooms',
                'Landscaped Atriums',
                'Mailbox Area',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
            ],
            'Fortis Residence' => [
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Exit',
                'Landscaped Atriums',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
                'Reception Lobby',
            ],
            'Moncello Crest' => [
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Cabinets',
                'Fire Exit',
                'Landscaped Atriums',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
                'Reception Lobby',
                'Garbage Rooms',
            ],
            'Mulberry Place' => [
                'Deck Utility/ Service Area',
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Exit',
                'Garbage Rooms',
                'Mailbox Area',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
                'Reception Lobby',
            ],
            'Oak Harbor Residences' => [
                'Deck Utility/ Service Area',
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Cabinets',
                'Fire Exit',
                'Garbage Rooms',
                'Landscaped Atriums',
                'Mailbox Area',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
                'Sky Patio (Lumiventt Technology)',
                'Service Elevator',
                '100% Back Up Power',
                'Car Wash Bays',
                'Proximity Access',
            ],
            'One Delta Terraces' => [
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Cabinets',
                'Fire Exit',
                'Garbage Rooms',
                'Landscaped Atriums',
                'Sky Patio (Lumiventt Technology)',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
                'Reception Lobby',
            ],
            'Prisma Residence' => [
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Cabinet',
                'Fire Exit',
                'Garbage Rooms',
                'Landscaped Atriums',
                'Mailbox Area',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
                'Reception Lobby',
            ],
            'Sage Residence' => [
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Cabinets',
                'Fire Exit',
                'Garbage Rooms',
                'Landscaped Atriums',
                'Sky Patio (Lumiventt Technology)',
                'Parcel Storage',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
            ],
            'Satory Residence' => [
                'Deck Utility/ Service Area',
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Hose Cabinets',
                'Fire Exit',
                'Garbage Rooms',
                'Landscaped Atriums',
                'Mailbox Area',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
                'Reception Lobby',
                'Sky Patio (Lumiventt Technology)',
            ],
            'Solmera Coast' => [
                'Deck Utility/ Service Area',
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Cabinets',
                'Fire Exit',
                'Landscaped Atriums',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
            ],
            'Sonora Garden Residences' => [
                'Deck Utility/Service Area',
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Cabinets',
                'Fire Exit',
                'Garbage Rooms',
                'Landscaped Atriums',
                'Sky Patio (Lumiventt Technology)',
                'Mailbox Area',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
            ],
            'The Atherton' => [
                // No building features available
            ],
            'The Calinea Tower' => [
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Cabinets',
                'Fire Exit',
                'Garbage Chute',
                'Landscaped Atriums',
                'Mailbox Area',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
            ],
            'The Campden Place' => [
                // Building features are not available for this property.
            ],
            'The Crestmont' => [
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Cabinets',
                'Fire Exit',
                'Garbage Rooms',
                'Landscaped Atriums',
                'Breezeway',
                'Mailbox Area',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
            ],
            'The Erin Heights' => [
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Cabinets',
                'Fire Exit',
                'Garbage Rooms',
                'Landscaped Atriums',
                'Mailbox Area',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
            ],
            'The Oriana' => [
                // Building features not provided, please add if available
            ],
            'The Valeron Tower' => [
                'Fire Alarm & Automatic Sprinkler System',
                'Fire Exit',
                'Garbage Rooms',
                'Sky Patio (Lumiventt Technology)',
                'Mailbox Area',
                'Parking Space',
                'Passenger Elevators',
                'Provision for CCTV',
                'Reception Lobby',
            ],


        ];

        foreach ($buildings as $buildingName => $features) {
            // Retrieve the property ID dynamically
            $property = Property::where('name', $buildingName)->first();
        
            // Insert features if property exists
            if ($property) {
                foreach ($features as $feature) {
                    DB::table('building_features')->insert([
                        'building_id' => $property->id, // Use property_id as building_id
                        'name' => $feature,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}