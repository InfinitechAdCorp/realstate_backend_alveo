<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property; 
class PropertySeeder extends Seeder
{
    public function run()
    {
        // Create properties if they don't already exist
        $properties = [
            [
                'key' => 'pasaycity',
                'name' => 'Anissa Heights',
                'status' => 'New',
                'location' => 'Pasay City',
                'specific_location' => 'P. Zamora St., Brgy. 101, San Roque District, Pasay City',
                'price_range' => 'PHP3,098,600 - PHP3,600,000',
                'units' => 'N/A',
                'land_area' => '4,000 sqm.',
                'development_type' => 'High Rise Condominiums',
                'architectural_theme' => 'Modern Contemporary',
                'path' => 'assets/Location/Residences View/Anissa Heights View.jpg',
                'view' => 'assets/Location/Residences View/Anissa Heights Master Plan.jpg',
                'features' =>\json_encode([
                    ['name' => 'Childrens Playground', 'image' => 'assets\Location\Anissa Heights\Childrens Playground.jpg'],
                    ['name' => 'Drop-Off Area', 'image' => 'assets\Location\Anissa Heights\Drop-Off Area.jpg'],
                    ['name' => 'Fitness Gym', 'image' => 'assets\Location\Anissa Heights\Fitness Gym.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\Anissa Heights\Kiddie Pool.jpg'],
                    ['name' => 'Landscaped Gardens', 'image' => 'assets\Location\Anissa Heights\Landscaped Gardens.jpg'],
                    ['name' => 'Leisure Pool', 'image' => 'assets\Location\Anissa Heights\Leisure Pool.jpg'],
                    ['name' => 'Lounge Area', 'image' => 'assets\Location\Anissa Heights\Lounge Area.jpg'],
                    ['name' => 'Pool Deck', 'image' => 'assets\Location\Anissa Heights\Pool Deck.jpg'],
                    ['name' => 'Shooting Court', 'image' => 'assets\Location\Anissa Heights\Shooting Court.jpg'],
                    ['name' => 'Sky Lounge', 'image' => 'assets\Location\Anissa Heights\Sky Lounge.jpg'],
                    ['name' => 'Sky Promenade', 'image' => 'assets\Location\Anissa Heights\Sky Promenade.jpg'],
                    ['name' => 'Passenger Elevator', 'image' => 'assets\Location\Anissa Heights\Building\Building Feature - Passenger Elevators.jpg'],
                    ['name' => 'Reception Lobby', 'image' => 'assets\Location\Anissa Heights\Building\Building Feature - Reception Lobby.jpg'],
                ])
            ],
            [
                'key' => 'pasigcity',
                'name' => 'Allegra Garden Place',
                'status' => 'Under Construction', // Updated status
                'location' => 'Pasig', // Updated location
                'specific_location' => 'Pasig Boulevard, Brgy. Bagong Ilog', // Updated specific location
                'price_range' => 'PHP4,670,020 - PHP13,388,520', // Updated price range
                'units' => '1BR, 2BR, 3BR, STUDIO', // Updated units
                'land_area' => '12,676 sqm.', // Updated land area
                'development_type' => 'High Rise Condominiums', // Updated development type
                'architectural_theme' => 'Modern with Moroccan Inspiration', // Updated architectural theme
                'path' => 'assets/Location/Residences View/Allegra Garden Place View.png',
                'view' => 'assets/Location/Residences View/Allegra Garden Place Master Plan.png',
                'features' =>\json_encode([
                    ['name' => 'Childrens Play Area', 'image' => 'assets\Location\Allegra Garden Place\Childrens Play Area.jpg'],
                    ['name' => 'Covered Multipurpose Court', 'image' => 'assets\Location\Allegra Garden Place\Covered Multipurpose Court.jpg'],
                    ['name' => 'Entrance Gate', 'image' => 'assets\Location\Allegra Garden Place\Entrance Gate.jpg'],
                    ['name' => 'Jogging Path', 'image' => 'assets\Location\Allegra Garden Place\Jogging Path.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\Allegra Garden Place\Kiddie Pool.jpg'],
                    ['name' => 'Lap Pool', 'image' => 'assets\Location\Allegra Garden Place\Lap Pool.jpg'],
                    ['name' => 'Leisure Pool', 'image' => 'assets\Location\Allegra Garden Place\Leisure Pool.jpg'],
                    ['name' => 'Lounge Area', 'image' => 'assets\Location\Allegra Garden Place\Lounge Area.jpg'],
                    ['name' => 'Sky Lounge', 'image' => 'assets\Location\Allegra Garden Place\Sky Lounge.jpg'],
                    ['name' => 'Reception Lobby', 'image' => 'assets\Location\Allegra Garden Place\Building\Building Feature - Reception Lobby.jpg'],
                    ['name' => 'Sky Patio', 'image' => 'assets\Location\Allegra Garden Place\Building\Building Feature - Sky Patio (Lumiventt Technology).jpg'],
                ])
            ],
            [
                'key' => 'makaticity',
                'name' => 'Fortis Residence', // New property
                'status' => 'Under Construction', // Status
                'location' => 'Makati City', // Location
                'specific_location' => 'Chino Roces Avenue, Makati City', // Specific location
                'price_range' => 'PHP13,832,000 - PHP38,596,000', // Price range
                'units' => '1BR, 2BR, 3BR', // Units
                'land_area' => '7,200 sqm.', // Land area
                'development_type' => 'High Rise Condominiums', // Development type
                'architectural_theme' => 'Modern Contemporary', // Architectural theme
                'path' => 'assets/Location/Residences View/Fortis Residence View.jpg',
                'view' => 'assets/Location/Residences View/Fortis Residence Master Plan.jpg',
                'features' =>\json_encode([
                    ['name' => 'Arrival Court', 'image' => 'assets\Location\Fortis Residences\Arrival Court.jpg'],
                    ['name' => 'Basketball Court', 'image' => 'assets\Location\Fortis Residences\BasketBall Court.jpeg'],
                    ['name' => 'Lap Pool', 'image' => 'assets\Location\Fortis Residences\Lap Pool.jpg'],
                    ['name' => 'Lounge Area', 'image' => 'assets\Location\Fortis Residences\Lounge Area.jpg'],
                    ['name' => 'Pool Deck', 'image' => 'assets\Location\Fortis Residences\Pool Deck.jpg'],
                    ['name' => 'Sky Lounge', 'image' => 'assets\Location\Fortis Residences\Sky Lounge.jpg'],
                    ['name' => 'Sky Patio (Lumivent Technology)', 'image' => 'assets\Location\Fortis Residences\Building\Building Feature-Sky Patio (Lumiventt Technology).jpg'],
                ])
            ],
            [
                'key' => 'bunguet',
                'name' => 'Moncello Crest', // New property
                'status' => 'New', // Status
                'location' => 'Tuba, Benguet', // Location
                'specific_location' => 'Sitio Bato, via Bontiway, Brgy. Poblacion, Tuba, Benguet', // Specific location
                'price_range' => 'PHP7,750,000 - PHP17,400,000', // Price range
                'units' => '1BR, 2BR, STUDIO', // Units
                'land_area' => '40,768 sqm.', // Land area
                'development_type' => 'Leisure Residences', // Development type
                'architectural_theme' => 'Modern Filipino', // Architectural theme
                'path' => 'assets/Location/Residences View/Moncello Crest View.jpg',
                'view' => 'assets/Location/Residences View/Moncello Crest Master Plan.jpg',
                'features' =>\json_encode([
                    ['name' => 'Children Playground', 'image' => 'assets\Location\Moncello Crest\Children Playground.jpg'],
                    ['name' => 'Childrens Recreation SpaceDayCare', 'image' => 'assets\Location\Moncello Crest\Childrens Recreation SpaceDaycare.jpg'],
                    ['name' => 'Fire Pit', 'image' => 'assets\Location\Moncello Crest\Fire Pit.jpg'],
                    ['name' => 'Landscaped Gardens', 'image' => 'assets\Location\Moncello Crest\Landscaped Gardens.jpg'],
                    ['name' => 'Multipurpose Court', 'image' => 'assets\Location\Moncello Crest\Multipurpose Court.jpg'],
                    ['name' => 'Open Sky Lounge', 'image' => 'assets\Location\Moncello Crest\Open Sky Lounge.jpg'],
                    ['name' => 'Sky Deck', 'image' => 'assets\Location\Moncello Crest\Sky Deck.jpg'],
                    ['name' => 'Viewing Deck', 'image' => 'assets\Location\Moncello Crest\Viewing Deck.jpg'],
                    ['name' => 'Water Garden', 'image' => 'assets\Location\Moncello Crest\Water Garden.jpg'],
                    ['name' => 'Sky Patio (Lumivent Technology)', 'image' => 'assets\Location\Moncello Crest\Building\Building Feature -Sky Patio (Lumiventt Technology).jpg'],
                ])
            ],
            [
                'key' => 'taguigcity',
                'name' => 'Mulberry Place', // New property
                'status' => 'Ready for Occupancy, Home Ready Promo', // Status
                'location' => 'Taguig City', // Location
                'specific_location' => 'Acacia Estates, Taguig City', // Specific location
                'price_range' => 'PHP7,301,000 - PHP25,844,000', // Price range
                'units' => '2BR, 3BR, 4BR', // Units
                'land_area' => '36,474 sqm.', // Land area
                'development_type' => 'Mid Rise Condominiums, High Rise Condominiums', // Development type
                'architectural_theme' => 'Asian Tropical Theme', // Architectural theme
                'path' => 'assets/Location/Residences View/Malberry Place View.jpg',
                'view' => 'assets/Location/Residences View/Mulberry Place Master Plan.png', // Check for correct name in your assets
                'features' =>\json_encode([
                    ['name' => 'AV Room 2', 'image' => 'assets\Location\Mulberry Place\AV Room 2.jpg'],
                    ['name' => 'AV Room', 'image' => 'assets\Location\Mulberry Place\AV Room.jpg'],
                    ['name' => 'Bar Area', 'image' => 'assets\Location\Mulberry Place\Bar Area.jpg'],
                    ['name' => 'Clubhouse', 'image' => 'assets\Location\Mulberry Place\Clubhouse.jpg'],
                    ['name' => 'Fitness Gym', 'image' => 'assets\Location\Mulberry Place\Fitness Gym.jpg'],
                    ['name' => 'Function Hall', 'image' => 'assets\Location\Mulberry Place\Function Hall.jpg'],
                    ['name' => 'Game Room', 'image' => 'assets\Location\Mulberry Place\Game Room.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\Mulberry Place\Kiddie Pool.jpg'],
                    ['name' => 'Lap Pool', 'image' => 'assets\Location\Mulberry Place\Lap Pool.jpg'],
                    ['name' => 'Lounge Area', 'image' => 'assets\Location\Mulberry Place\Lounge Area.jpg'],
                    ['name' => 'Main Entrance Gate', 'image' => 'assets\Location\Mulberry Place\Main Entrance Gate.jpg'],
                    ['name' => 'Landscapd Atriums', 'image' => 'assets\Location\Mulberry Place\Building\Building Feature-Landscaped Atriums.jpg'],
                    // Add more features here
                ])
            ],
            [
                'key' => 'paranaquecity',
                'name' => 'Oak Harbor Residences', // New property
                'status' => 'Ready for Occupancy', // Status
                'location' => 'Paranaque', // Location
                'specific_location' => 'Jackson Ave. Asiaworld City, Brgy. Don Galo, Parañaque City', // Specific location
                'price_range' => 'PHP11,888,000 - PHP56,588,000', // Price range
                'units' => '1BR, 2BR, 3BR, LOFT', // Units
                'land_area' => '11,871 sqm.', // Land area
                'development_type' => 'Mid Rise Condominiums', // Development type
                'architectural_theme' => 'Asian Contemporary', // Architectural theme
                'path' => 'assets/Location/Residences View/Oak Harbor Residence View.jpg',
                'view' => 'assets/Location/Residences View/Oak Harbor Residence Master Plan.png',
                'features' =>\json_encode([
                    ['name' => 'Altana Hall', 'image' => 'assets\Location\Oak Harbor Residences\Altana Hall.jpg'],
                    ['name' => 'AV Room', 'image' => 'assets\Location\Oak Harbor Residences\AV Room.jpg'],
                    ['name' => 'Fitness Gym', 'image' => 'assets\Location\Oak Harbor Residences\Fitness Gym.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\Oak Harbor Residences\Kiddie Pool.jpg'],
                    ['name' => 'Lounge Pool', 'image' => 'assets\Location\Oak Harbor Residences\Lounge Pool.jpg'],
                    ['name' => 'Snack Bar', 'image' => 'assets\Location\Oak Harbor Residences\Snack Bar.jpg'],
                    ['name' => 'The Colonnade', 'image' => 'assets\Location\Oak Harbor Residences\The Colonnade.jpg'],
                    ['name' => 'The Marella Deek', 'image' => 'assets\Location\Oak Harbor Residences\The Marella Deek.jpg'],
                    ['name' => 'The Promenade', 'image' => 'assets\Location\Oak Harbor Residences\The Promenade.jpg'],
                    ['name' => 'Water Station', 'image' => 'assets\Location\Oak Harbor Residences\Water Station.jpg'],
                    ['name' => 'Reception Lobby', 'image' => 'assets\Location\Oak Harbor Residences\Building\Building Feature - Reception Lobby.jpg'],
                ])
            ],
            [
                'key' => 'quezoncity',
                'name' => 'One Delta Terraces', // New property
                'status' => 'New', // Status
                'location' => 'Quezon City', // Location
                'specific_location' => 'West Ave. corner Quezon Ave, Quezon City, Metro Manila', // Specific location
                'price_range' => 'PHP6,876,000 - PHP21,712,000', // Price range
                'units' => '2BR, 3BR, STUDIO', // Units
                'land_area' => 'N/A', // Land area
                'development_type' => 'High Rise Condominiums', // Development type
                'architectural_theme' => 'N/A', // Architectural theme
                'path' => 'assets/Location/Residences View/One Delta Terraces View.jpg',
                'view' => 'assets/Location/Residences View/One Delta Terraces Master Plan.jpg',
                'features' =>\json_encode([
                    ['name' => 'Childrens Playground', 'image' => 'assets\Location\One Delta Terraces\Childrens Playground.png'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\One Delta Terraces\Kiddie Pool.png'],
                    ['name' => 'Lounge Pool', 'image' => 'assets\Location\One Delta Terraces\Lounge Pool.png'],
                    ['name' => 'Sky Park', 'image' => 'assets\Location\One Delta Terraces\Sky Park.png'],
                    ['name' => 'Sky Patio', 'image' => 'assets\Location\One Delta Terraces\Sky Patio.png'],
                    ['name' => 'Sky Promenade', 'image' => 'assets\Location\One Delta Terraces\Sky Promenade.png'],
                    ['name' => 'Sky Deck Pool', 'image' => 'assets\Location\One Delta Terraces\Skydeck Pool.png'],
                ])
            ],
            [
                'key' => 'pasigcity',
                'name' => 'Prisma Residence', // New property
                'status' => 'Ready for Occupancy', // Status
                'location' => 'Pasig', // Location (assuming it's Pasig based on specific location)
                'specific_location' => 'Pasig Boulevard, Brgy. Bagong Ilog', // Specific location
                'price_range' => 'PHP4,562,000 - PHP12,174,000', // Price range
                'units' => '1BR, 2BR', // Units
                'land_area' => '20,380 sqm.', // Land area
                'development_type' => 'High Rise Condominiums', // Development type
                'architectural_theme' => 'Modern Tropical', // Architectural theme
                'path' => 'assets/Location/Residences View/Prisma Residence View.png',
                'view' => 'assets/Location/Residences View/Prisma Residence Master Plan.png',
                'features' =>\json_encode([
                    ['name' => 'Children Playground', 'image' => 'assets\Location\Prisma Residences\Children Playground.jpg'],
                    ['name' => 'Gazebo Cabana', 'image' => 'assets\Location\Prisma Residences\Gazebo Cabana.jpg'],
                    ['name' => 'Jogging Biking Path', 'image' => 'assets\Location\Prisma Residences\Jogging Biking Path.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\Prisma Residences\Kiddie Pool.jpg'],
                    ['name' => 'Lap Pool', 'image' => 'assets\Location\Prisma Residences\Lap Pool.jpg'],
                    ['name' => 'Lounge Pool', 'image' => 'assets\Location\Prisma Residences\Lounge Pool.jpg'],
                    ['name' => 'Main Entrance Gate', 'image' => 'assets\Location\Prisma Residences\Main Entrance Gate.jpg'],
                    ['name' => 'Open Lawn Picnic Grove', 'image' => 'assets\Location\Prisma Residences\Open Lawn Picnic Grove.jpg'],
                    ['name' => 'Roof Deck', 'image' => 'assets\Location\Prisma Residences\Roof Deck.jpg'],
                    ['name' => 'Sky Patio', 'image' => 'assets\Location\Prisma Residences\Building\Building Feature - Sky Patio.jpg'],
                    // Add more features here
                ])
            ],
            [
                'key' => 'mandaluyongcity',
                'name' => 'Sage Residence', // New property
                'status' => 'Under Construction', // Status
                'location' => 'Mandaluyong City', // Location
                'specific_location' => 'Domingo M. Guevara and Sinag Streets, Mauway, Mandaluyong City', // Specific location
                'price_range' => 'PHP6,464,000 - PHP15,761,000', // Price range
                'units' => '1BR, 2BR, 3BR, STUDIO', // Units
                'land_area' => '5,995 sqm.', // Land area
                'development_type' => 'High Rise Condominiums', // Development type
                'architectural_theme' => 'Modern-tropical', // Architectural theme
                'path' => 'assets/Location/Residences View/Sage Residence View.jpg',
                'view' => 'assets/Location/Residences View/Sage Residence Master Plan.jpg',
                'features' =>\json_encode([
                    ['name' => 'Drop-Off Area', 'image' => 'assets\Location\Sage Residences\Drop-Off Area.jpg'],
                    ['name' => 'Entertainment Room', 'image' => 'assets\Location\Sage Residences\Entertainment Room.jpg'],
                    ['name' => 'Fitness Gym', 'image' => 'assets\Location\Sage Residences\Fitness Gym.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\Sage Residences\Kiddie Pool.jpg'],
                    ['name' => 'Leisure Pool', 'image' => 'assets\Location\Sage Residences\Leisure Pool.jpg'],
                    ['name' => 'Lounge Area', 'image' => 'assets\Location\Sage Residences\Lounge Area.jpg'],
                    ['name' => 'Main Entrance Gate', 'image' => 'assets\Location\Sage Residences\Main Entrance Gate.jpg'],
                    ['name' => 'Picnic Grove', 'image' => 'assets\Location\Sage Residences\Picnic Grove.jpg'],
                    ['name' => 'Play Area', 'image' => 'assets\Location\Sage Residences\Play Area.jpg'],
                    ['name' => 'Pool Deck', 'image' => 'assets\Location\Sage Residences\Pool Deck.jpg'],
                    ['name' => 'Sky Deck Pool', 'image' => 'assets\Location\Sage Residences\Sky Deck Pool.jpg'],
                    ['name' => 'Sky Lounge', 'image' => 'assets\Location\Sage Residences\Sky Lounge.jpg'],
              
                    // Add more features here
                ])
            ],
            [
                'key' => 'pasigcity',
                'name' => 'Satory Residence', // New property
                'status' => 'Ready for Occupancy', // Status
                'location' => 'Pasig City', // Location
                'specific_location' => 'F. Pasco Avenue, Santolan, Pasig City', // Specific location
                'price_range' => 'PHP4,437,000 - PHP8,376,000', // Price range
                'units' => '1BR, 2BR', // Units
                'land_area' => '29,170 sqm.', // Land area
                'development_type' => 'High Rise Condominiums', // Development type
                'architectural_theme' => 'Neo-Asian Minimalist', // Architectural theme
                'path' => 'assets/Location/Residences View/Satori Residence View.png',
                'view' => 'assets/Location/Residences View/Satory Residence Master Plan.png',
                'features' =>\json_encode([
                    ['name' => 'Children Playground', 'image' => 'assets\Location\Satori Residences\Childrens Playground.jpg'],
                    ['name' => 'Jogging path', 'image' => 'assets\Location\Satori Residences\Jogging Path.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\Satori Residences\Kiddie Pool.jpg'],
                    ['name' => 'Lap Pool', 'image' => 'assets\Location\Satori Residences\Lap Pool.jpg'],
                    ['name' => 'Lounge Pool', 'image' => 'assets\Location\Satori Residences\Lounge Pool.jpg'],
                    ['name' => 'Main Entrance Gate', 'image' => 'assets\Location\Satori Residences\Main Entrance Gate.jpg'],
                    ['name' => 'Multi Purpose Court', 'image' => 'assets\Location\Satori Residences\Multi-Purpose Court.jpg'],
     
                    // Add more features here
                ])
            ],
            [
                'key' => 'batangascity',
                'name' => 'Solmera Coast', // New property
                'status' => 'Under Construction', // Status
                'location' => 'San Juan, Batangas', // Location
                'specific_location' => 'Brgy. Calubcub II and Brgy. Subukin', // Specific location
                'price_range' => 'PHP6,395,000 - PHP19,321,000', // Price range
                'units' => '1BR, 2BR, STUDIO', // Units
                'land_area' => '75,367 sqm.', // Land area
                'development_type' => 'Mid Rise Condominiums, Leisure Residences', // Development type
                'architectural_theme' => 'Asian Tropical', // Architectural theme
                'path' => 'assets/Location/Residences View/Solmera Coast View.jpg',
                'view' => 'assets/Location/Residences View/Solmera Coast Master Plan.jpg',
                'features' =>\json_encode([
                    ['name' => 'Balcony View', 'image' => 'assets\Location\Solmera Coast\Balcony View.jpg'],
                    ['name' => 'Beach Dining', 'image' => 'assets\Location\Solmera Coast\Beach Dining.jpg'],
                    ['name' => 'Drop Off Area', 'image' => 'assets\Location\Solmera Coast\Drop Off Area.jpg'],
                    ['name' => 'Infinity Pool', 'image' => 'assets\Location\Solmera Coast\Infinity Pool.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\Solmera Coast\Kiddie Pool.jpg'],
                    ['name' => 'Landscaped Gardens', 'image' => 'assets\Location\Solmera Coast\Landscaped Gardens.jpg'],
                    ['name' => 'Lap Pool', 'image' => 'assets\Location\Solmera Coast\Lap Pool.jpg'],
                    ['name' => 'Lounge Area', 'image' => 'assets\Location\Solmera Coast\Lounge Area.jpg'],
                    ['name' => 'Pool Pavilion', 'image' => 'assets\Location\Solmera Coast\Pool Pavilion.jpg'],
                    ['name' => 'Sky Deck Pool', 'image' => 'assets\Location\Solmera Coast\Sky Deck Pool.jpg'],
                    ['name' => 'Sky Deck', 'image' => 'assets\Location\Solmera Coast\Sky Deck.jpg'],
                    ['name' => 'Sky Lounge', 'image' => 'assets\Location\Solmera Coast\Sky Lounge.jpg'],
                    ['name' => 'SnackBar', 'image' => 'assets\Location\Solmera Coast\Snack Bar.jpg'],
              
                    // Add more features here
                ])
            ],
            [
                'key' => 'laspinas',
                'name' => 'Sonora Garden Residences', // New property
                'status' => 'Under Construction', // Status
                'location' => 'Las Pinas', // Location
                'specific_location' => 'Alabang–Zapote Road, Talon Tres, Las Pinas', // Specific location
                'price_range' => 'PHP4,444,000 - PHP10,934,000', // Price range
                'units' => '1BR, 2BR, 3BR', // Units
                'land_area' => '14,492 sqm.', // Land area
                'development_type' => 'High Rise Condominiums, Mid Rise Condominiums', // Development type
                'architectural_theme' => 'Modern Contemporary', // Architectural theme
                'path' => 'assets/Location/Residences View/Sonora Garden Residences View.jpg',
                'view' => 'assets/Location/Residences View/Sonora Garden Master Plan.png', // Add correct image path
                'features' =>\json_encode([
                    ['name' => 'Activity Lawn', 'image' => 'assets\Location\Sonora Garden Residence\Activity Lawn.jpg'],
                    ['name' => 'Balcony View', 'image' => 'assets\Location\Sonora Garden Residence\Balcony View.jpg'],
                    ['name' => 'Children Playground', 'image' => 'assets\Location\Sonora Garden Residence\Children Playground.jpg'],
                    ['name' => 'Entertainment Room', 'image' => 'assets\Location\Sonora Garden Residence\Entertainment Room.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\Sonora Garden Residence\Kiddie Pool.jpg'],
                    ['name' => 'Lap Pool', 'image' => 'assets\Location\Sonora Garden Residence\Lap Pool.jpg'],
                    ['name' => 'Leisure Pool', 'image' => 'assets\Location\Sonora Garden Residence\Leisure Pool.jpg'],
                    ['name' => 'Lounge Area', 'image' => 'assets\Location\Sonora Garden Residence\Lounge Area.jpg'],
                    ['name' => 'Main Entrance Gate', 'image' => 'assets\Location\Sonora Garden Residence\Main Entrance Gate.jpg'],
                    ['name' => 'Picnic Area', 'image' => 'assets\Location\Sonora Garden Residence\Picnic Area.jpg'],
                    ['name' => 'Sky Lounge', 'image' => 'assets\Location\Sonora Garden Residence\Sky Lounge.jpg'],
                    ['name' => 'Snack Bar', 'image' => 'assets\Location\Sonora Garden Residence\Snack Bar.jpg'],
                    ['name' => 'Reception Lounge','image'=>'assets\Location\Sonora Garden Residence\Building\Building Feature - Reception Lounge.jpg'],
                    ['name' => 'Sky Promenade','image'=>'assets\Location\Sonora Garden Residence\Building\Building Feature - Sky Promenade.jpg'],
                    // Add more features here
                ])
            ],
            [
                'key' => 'paranaquecity',
                'name' => 'The Atherton', // New property
                'status' => 'Ready for Occupancy', // Status
                'location' => 'Paranaque City', // Location
                'specific_location' => 'Dr. A. Santos Ave., Parañaque City', // Specific location
                'price_range' => 'PHP4,030,000 - PHP7,968,000', // Price range
                'units' => '1BR, 2BR', // Units
                'land_area' => '17,623 sqm.', // Land area
                'development_type' => 'High Rise Condominiums', // Development type
                'architectural_theme' => 'Modern Tropical', // Architectural theme
                'path' => 'assets/Location/Residences View/The Atherton Views.jpg',
                'view' => 'assets/Location/Residences View/The Atherton Master Plan.jpeg', // Add correct image path
                'features' =>\json_encode([
                    ['name' => 'Entrance Gate', 'image' => 'assets\Location\The Atherton\Entrance Gate.jpg'],
                    ['name' => 'Landscaped Gardens', 'image' => 'assets\Location\The Atherton\Landscaped Gardens.jpeg'],
                    ['name' => 'Lap Pool', 'image' => 'assets\Location\The Atherton\Lap Pool.jpg'],
                    ['name' => 'Leisure Pool', 'image' => 'assets\Location\The Atherton\Leisure Pool.jpg'],
                    ['name' => 'Multi Purpose Court', 'image' => 'assets\Location\The Atherton\Multi Purpose Court.jpeg'],
                    ['name' => 'Play Area', 'image' => 'assets\Location\The Atherton\Play Area.jpg'],
                    // Add more features here
                ])
            ],
            [
                'key' => 'caloocancity',
                'name' => 'The Calinea Tower', // New property
                'status' => 'Under Construction', // Status
                'location' => 'Caloocan City', // Location
                'specific_location' => 'M.H. Del Pilar St., Grace Park, Caloocan City', // Specific location
                'price_range' => 'PHP5,325,000 - PHP15,098,000', // Price range
                'units' => '1BR, 2BR, 3BR, STUDIO', // Units
                'land_area' => '7,472 sqm.', // Land area
                'development_type' => 'High Rise Condominiums', // Development type
                'architectural_theme' => 'Modern Contemporary', // Architectural theme

                'path' => 'assets/Location/Residences View/The Calinea Tower View.jpg',
                'view' => 'assets/Location/Residences View/The Calinea Tower Master Plan.png', // Add correct image path
                'features' =>\json_encode([
                    ['name' => 'Basketball Court', 'image' => 'assets\Location\The Calinea Tower\Basketball Court.jpeg'],
                    ['name' => 'Childrens Play Area', 'image' => 'assets\Location\The Calinea Tower\Childrens Play Area.jpg'],
                    ['name' => 'Coworking Space', 'image' => 'assets\Location\The Calinea Tower\Coworking Space.jpg'],
                    ['name' => 'Fitness Gym', 'image' => 'assets\Location\The Calinea Tower\Fitness Gym.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\The Calinea Tower\Kiddie Pool.jpg'],
                    ['name' => 'Lap Pool', 'image' => 'assets\Location\The Calinea Tower\Lap Pool.jpg'],
                    ['name' => 'Lounge Area', 'image' => 'assets\Location\The Calinea Tower\Lounge Area.jpg'],
                    ['name' => 'Main Entrance Gate', 'image' => 'assets\Location\The Calinea Tower\Main Entrance Gate.jpg'],
                    ['name' => 'Sky Deck Pool', 'image' => 'assets\Location\The Calinea Tower\Sky Deck Pool.jpg'],
                    ['name' => 'Sky Lounge', 'image' => 'assets\Location\The Calinea Tower\Sky Lounge.jpg'],
                    ['name' => 'Reception Lobby','image'=>'assets\Location\The Calinea Tower\Building\Building Feature - Reception Lobby.jpg'],
                    ['name' => 'Sky Promenade','image'=>'assets\Location\The Calinea Tower\Building\Building Feature - Sky Promenade.jpg'],
                    ['name' => 'Sky Patio ( Lumivent Technology)','image'=>'assets\Location\The Calinea Tower\Building\Building Feature -Sky Patio (Lumiventt Technology).jpg'],
                  
                    // Add more features here
                ])
            ],
            [  
                'key' => 'manila',
                'name' => 'The Campden Place', // New property
                'status' => 'Under Construction', // Status
                'location' => 'Manila', // Location
                'specific_location' => 'Dominga St., Malate, Manila', // Specific location
                'price_range' => 'PHP4,896,000 - PHP9,441,000', // Price range
                'units' => 'STUDIO', // Units
                'land_area' => '2,382 sqm.', // Land area
                'development_type' => 'High Rise Condominiums', // Development type
                'architectural_theme' => 'Modern Contemporary', // Architectural theme
                
                'path' => 'assets/Location/Residences View/The Campden Place View.png',
                'view' => 'assets/Location/Residences View/The Camden Place Master Plan.png', // Add correct image path
                'features' =>\json_encode([
                    ['name' => 'Lounge Area', 'image' => 'assets\Location\The Camden Place\Lounge Area.jpg'],
                    ['name' => 'Sky Deck Pool', 'image' => 'assets\Location\The Camden Place\Sky Deck Pool.jpg'],
                    ['name' => 'Sky Lounge', 'image' => 'assets\Location\The Camden Place\Sky Lounge.jpg'],
                    ['name' => 'Sky Promenade', 'image' => 'assets\Location\The Camden Place\Sky Promenade.jpg'],
                    ['name' => 'Snack Bar', 'image' => 'assets\Location\The Camden Place\Snack Bar.jpg'],
                    ['name' => 'Passenger Elevator','image'=>'assets\Location\The Camden Place\Building\Building Feature - Passenger Elevator.jpg'],
                    ['name' => 'Reception Lobby','image'=>'assets\Location\The Camden Place\Building\Building Feature - Reception Lobby.jpg'],
                    // Add more features here
                ])
            ],
            [
                'key' => 'quezoncity',
                'name' => 'The Crestmont', // New property
                'status' => 'Under Construction', // Status
                'location' => 'Quezon City', // Location
                'specific_location' => 'Panay Ave., South Triangle, Quezon City', // Specific location
                'price_range' => 'PHP6,271,000 - PHP15,106,000', // Price range
                'units' => '1BR, 2BR, 3BR', // Units
                'land_area' => '3,000 sqm.', // Land area
                'development_type' => 'High Rise Condominiums', // Development type
                'architectural_theme' => 'Modern Contemporary', // Architectural theme
                'path' => 'assets/Location/Residences View/The Crestmont View.jpg',
                'view' => 'assets/Location/Residences View/The Crestmont Master Plan.png', // Add correct image path
                'features' =>\json_encode([
                    ['name' => 'Childrens Play Area', 'image' => 'assets\Location\The Cresmont\Childrens Play Area.jpg'],
                    ['name' => 'Drop-Off Area', 'image' => 'assets\Location\The Cresmont\Drop-Off Area.jpg'],
                    ['name' => 'Entertainment Room', 'image' => 'assets\Location\The Cresmont\Entertainment Room.jpg'],
                    ['name' => 'Fitness Gym', 'image' => 'assets\Location\The Cresmont\Fitness Gym.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\The Cresmont\Kiddie Pool.jpg'],
                    ['name' => 'Lounge Area', 'image' => 'assets\Location\The Cresmont\Lounge Area.jpg'],
                    ['name' => 'Sky Deck Pool', 'image' => 'assets\Location\The Cresmont\Sky Deck Pool.jpg'],
                    ['name' => 'Sky Lounge', 'image' => 'assets\Location\The Cresmont\Sky Lounge.jpg'],
                    ['name' => 'Sky Promenade', 'image' => 'assets\Location\The Cresmont\Sky Promenade.jpg'],
                    ['name' => 'Reception Lobby','image'=>'assets\Location\The Cresmont\Building\Building Feature - Reception Lobby.jpg'],
                
                    // Add more features here
                ])
            ],
            [
                
                'key' => 'quezoncity',
                'name' => 'The Erin Heights', // New property
                'status' => 'Under Construction', // Status
                'location' => 'Quezon City', // Location
                'specific_location' => 'Commonwealth Ave. corner Tandang Sora Ave., Matandang Balara', // Specific location
                'price_range' => 'PHP4,881,000 - PHP29,842,000', // Price range
                'units' => '2BR, 3BR, STUDIO', // Units
                'land_area' => '6,103 sqm.', // Land area
                'development_type' => 'High Rise Condominiums', // Development type
                'architectural_theme' => 'Modern Tropical', // Architectural theme
                'path' => 'assets/Location/Residences View/The Erin Heights View.png',
                'view' => 'assets/Location/Residences View/The Erin Heights Master Plan.png', // Add correct image path
                'features' =>\json_encode([
                    ['name' => 'Childrens Playground', 'image' => 'assets\Location\The Erin Heights\Childrens Playground.jpg'],
                    ['name' => 'Drop-Off Area', 'image' => 'assets\Location\The Erin Heights\Drop-Off Area.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\The Erin Heights\Kiddie Pool.jpg'],
                    ['name' => 'Landscaped Gardens', 'image' => 'assets\Location\The Erin Heights\Landscaped Gardens.jpg'],
                    ['name' => 'Leisure Pool', 'image' => 'assets\Location\The Erin Heights\Leisure Pool.jpg'],
                    ['name' => 'Lounge Area', 'image' => 'assets\Location\The Erin Heights\Lounge Area.jpg'],
                    ['name' => 'Main Entrance Gate', 'image' => 'assets\Location\The Erin Heights\Main Entrance Gate.jpg'],
                    ['name' => 'Shooting Court', 'image' => 'assets\Location\The Erin Heights\Shooting Court.jpg'],
                    ['name' => 'Sky Deck Pool', 'image' => 'assets\Location\The Erin Heights\Sky Deck Pool.jpg'],
                    ['name' => 'Sky Lounge', 'image' => 'assets\Location\The Erin Heights\Sky Lounge.jpg'],
                    ['name' => 'Sky Park', 'image' => 'assets\Location\The Erin Heights\Sky Park.jpg'],
                    ['name' => 'Sky Promenade', 'image' => 'assets\Location\The Erin Heights\Sky Promenade.jpg'],
                    ['name' => 'Reception Lobby','image'=>'assets\Location\The Erin Heights\Building\Building Feature - Reception Lobby.jpg'],
                    ['name' => 'Sky Patio (Lumivent Technology)','image'=>'assets\Location\The Erin Heights\Building\Building Feature - Sky Patio (Lumiventt Technology).jpg'],
                    ['name' => 'Sky Promenade','image'=>'assets\Location\The Erin Heights\Building\Building Feature - Sky Promenade.jpg'],
                   
                    // Add more features here
                ])
    

                // Continue for remaining features
            ],
            [
                'key' => 'quezoncity',
                'name' => 'The Oriana', // New property
                'status' => 'Under Construction', // Status
                'location' => 'Quezon City', // Location
                'specific_location' => 'Aurora Blvd, Project 4, Quezon City', // Specific location
                'price_range' => 'PHP4,496,000 - PHP9,965,000', // Price range
                'units' => '1BR, 2BR, STUDIO', // Units
                'land_area' => '9,314 sqm.', // Land area
                'development_type' => 'High Rise Condominiums', // Development type
                'architectural_theme' => 'Modern Tropical', // Architectural theme
                'path' => 'assets/Location/Residences View/The Oriana View.png',
                'view' => 'assets/Location/Residences View/The Oriana Master Plan.png', // Add correct image path
                'features' =>\json_encode([
                    ['name' => 'Amenity Core', 'image' => 'assets\Location\The Oriana\Amenity Core.jpg'],
                    ['name' => 'Basketball Court', 'image' => 'assets\Location\The Oriana\BasketballCourt.jpg'],
                    ['name' => 'Coworking Space', 'image' => 'assets\Location\The Oriana\Coworking Space.jpg'],
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\The Oriana\Kiddie Pool.jpg'],
                    ['name' => 'Lap Pool', 'image' => 'assets\Location\The Oriana\Lap Pool.jpg'],
                    ['name' => 'Leisure Pool', 'image' => 'assets\Location\The Oriana\Leisure Pool.jpg'],
                    ['name' => 'Picnic Area', 'image' => 'assets\Location\The Oriana\Picnic Area.jpg'],
                    ['name' => 'Sky Bridge', 'image' => 'assets\Location\The Oriana\Sky Bridge.jpg'],
                    ['name' => 'Sky Patio', 'image' => 'assets\Location\The Oriana\Sky Patio.jpg'],
                    ['name' => 'Sky Prominade', 'image' => 'assets\Location\The Oriana\Sky Prominade.jpg'],
                ])
            ],
            [
                'key' => 'pasigcity',
                'name' => 'The Valeron Tower',
                'status' => 'New',
                'location' => 'Pasig City',
                'specific_location' => 'C-5 corner P.E. Antonio St., Brgy. Ugong, Pasig City',
                'price_range' => 'PHP7,513,000 - PHP17,924,000',
                'units' => '1BR, 2BR, 3BR, STUDIO',
                'land_area' => '8,390 sqm.',
                'development_type' => 'High Rise Condominiums',
                'architectural_theme' => 'Modern Artisanal',
                'path' => 'assets/Location/Residences View/The Valeron Tower View.jpg',
                'view' => 'assets/Location/Residences View/The Valeron Tower Master Plan.jpg',
                'features' =>\json_encode([
                    ['name' => 'Kiddie Pool', 'image' => 'assets\Location\The Valeron Tower\Kiddie Pool.jpg'],
                    ['name' => 'Leisure Pool', 'image' => 'assets\Location\The Valeron Tower\Leisure Pool.jpg'],
                    ['name' => 'Sky Lounge', 'image' => 'assets\Location\The Valeron Tower\Sky Lounge.jpg'],
                    ['name' => 'Sky Promenade', 'image' => 'assets\Location\The Valeron Tower\Sky Promenade.jpg'],
                    ['name' => 'Skydeck Pool', 'image' => 'assets\Location\The Valeron Tower\Skydeck Pool.jpg'],
                    // Add more features here
                ])
            ]
            // Add other properties as needed
        ];
        

        foreach ($properties as $propertyData) {
            Property::updateOrCreate(
                ['name' => $propertyData['name']], // Check for existing property by name
                $propertyData // Create or update with these attributes
            );
        }
    }
}
