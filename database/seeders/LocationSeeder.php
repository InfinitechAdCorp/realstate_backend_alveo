<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area; 
class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
 public function run()
    {
        // Define the locations data
        $locations = [
            [
                'area_name' => "Caloocan City",
                'title' => "Thriving in the Heart of Heritage and Progress",
                'description' => "This vibrant metropolis blends rich history with modern urban life. Known for its thriving business hubs and lively markets, it offers convenience for residents and visitors alike.",
                'image' => "/assets/Location/Location View/Caloocan City.png"
            ],
            [
                'area_name' => "Las Pinas",
                'title' => "Where Tradition Meets Tranquility: Life in Las Piñas",
                'description' => "A unique blend of historical charm and peaceful suburban living awaits here. Famous for its iconic bamboo organ, it preserves cultural heritage while providing modern conveniences.",
                'image' => "/assets/Location/Location View/Las Pinas.jpg"
            ],
            [
                'area_name' => "Makati City",
                'title' => "The Pulse of Progress: Life in Makati City",
                'description' => "As the premier financial and commercial hub of the region, this city is known for its sleek skyline and vibrant lifestyle. It pulses with the energy of progress and sophistication.",
                'image' => "/assets/Location/Location View/Makati City.jpeg"
            ],
            [
                'area_name' => "Mandaluyong City",
                'title' => "The Crossroads of Commerce and Community: Life in Mandaluyong City",
                'description' => "Here, the perfect balance between commercial vitality and community living is struck. Known as the 'Tiger City,' it offers a dynamic yet welcoming environment for all.",
                'image' => "/assets/Location/Location View/Mandaluyong.jpg"
            ],
            [
                'area_name' => "Manila",
                'title' => "Where History and Modernity Converge: Life in Manila",
                'description' => "This vibrant capital is where centuries of history blend seamlessly with modern urban life. From iconic landmarks to lively markets, it captivates with its depth and diversity.",
                'image' => "/assets/Location/Location View/Manila.jpeg"
            ],
            [
                'area_name' => "Pasay City",
                'title' => "The Gateway to Leisure and Culture: Life in Pasay City",
                'description' => "A gateway to leisure and culture, this area offers world-class entertainment venues and vibrant lifestyle hubs. With endless opportunities for recreation, it caters to both locals and tourists alike.",
                'image' => "/assets/Location/Location View/Pasay.png"
            ],
            [
                'area_name' => "Pasig City",
                'title' => "The Gateway to Leisure and Culture: Life in Pasig City",
                'description' => "A gateway to leisure and culture, this area offers world-class entertainment venues and vibrant lifestyle hubs. With endless opportunities for recreation, it caters to both locals and tourists alike.",
                'image' => "/assets/Location/Location View/Pasig City.png"
            ],
            [
                'area_name' => "Paranaque City",
                'title' => "The Vibrant Blend of Culture and Commerce: Life in Parañaque City",
                'description' => "This dynamic urban hub is where culture and commerce intersect. Renowned for its rich history and diverse communities, it boasts bustling markets and a lively nightlife scene.",
                'image' => "/assets/Location/Location View/Paranaque.jpg"
            ],
            [
                'area_name' => "Quezon City",
                'title' => "The City of Innovation and Heritage: Life in Quezon City",
                'description' => "A vibrant tapestry woven from rich history and modern innovation awaits you. With significant landmarks and a hub of education and culture, it offers diverse dining and entertainment options.",
                'image' => "/assets/Location/Location View/Quezon City.jpg"
            ],
            [
                'area_name' => "San Juan, Batangas",
                'title' => "The Charming Retreat of San Juan: Where Coastal Beauty Meets Community",
                'description' => "This picturesque coastal town is renowned for its stunning beaches and rich cultural heritage. Often referred to as the 'Surfing Capital of the Philippines,' it attracts water sports enthusiasts and beach lovers alike.",
                'image' => "/assets/Location/Location View/San Juan, Batangas.png"
            ],
            [
                'area_name' => "Taguig City",
                'title' => "The Modern Marvel of Taguig: A City of Innovation and Lifestyle",
                'description' => "An emerging powerhouse in the region, this area is a testament to modern urban development and innovation. It offers a vibrant hub for business, upscale retail, and fine dining.",
                'image' => "/assets/Location/Location View/Taguig City.jpg"
            ],
            [
                'area_name' => "Tuba, Benguet",
                'title' => "The Mountain Oasis of Tuba: Nature’s Haven in Benguet",
                'description' => "A serene mountain retreat awaits, offering breathtaking natural beauty and rich cultural heritage. Surrounded by lush pine forests, it is known for its stunning landscapes and vibrant flower farms.",
                'image' => "/assets/Location/Location View/Tuba Benguet.png"
            ]
        ];

        // Insert each location into the areas table
        foreach ($locations as $location) {
            Area::create([
                'area_name' => $location['area_name'],
                'title' => $location['title'],
                'description' => $location['description'],
                'image' => $location['image'],
            ]);
        }
    }

    }

