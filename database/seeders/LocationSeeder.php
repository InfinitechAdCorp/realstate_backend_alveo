<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location; 
class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  public function run()
    {
        $locations = [
            ["name" => "Anissa Heights", "location" => "Pasay City", "specific_location" => "P. Zamora St., Brgy. 101, San Roque District, Pasay City", "location_image" => "/assets/Location/Residences View/Anissa Heights View.jpg", "lat" => 14.5333, "lng" => 120.9893],
    ["name" => "Allegra Garden Place", "location" => "Pasig City", "specific_location" => "Pasig Boulevard, Brgy. Bagong Ilog", "location_image" => "/assets/Location/Residences View/Allegra Garden Place View.png", "lat" => 14.5733, "lng" => 121.0594],
    ["name" => "Fortis Residence", "location" => "Makati City", "specific_location" => "Chino Roces Avenue, Makati City", "location_image" => "/assets/Location/Residences View/Fortis Residence View.jpg", "lat" => 14.5547, "lng" => 121.0244],
    ["name" => "Moncello Crest", "location" => "Tuba, Benguet", "specific_location" => "Sitio Bato, via Bontiway, Brgy. Poblacion, Tuba, Benguet", "location_image" => "/assets/Location/Residences View/Moncello Crest View.jpg", "lat" => 16.4225, "lng" => 120.3502],
    ["name" => "Mulberry Place", "location" => "Taguig City", "specific_location" => "Acacia Estates, Taguig City", "location_image" => "/assets/Location/Residences View/Malberry Place View.jpg", "lat" => 14.5277, "lng" => 121.0582],
    ["name" => "Oak Harbor Residences", "location" => "Parañaque City", "specific_location" => "Jackson Ave. Asiaworld City, Brgy. Don Galo, Parañaque City", "location_image" => "/assets/Location/Residences View/Oak Harbor Residence View.jpg", "lat" => 14.5081, "lng" => 120.9890],
    ["name" => "One Delta Terraces", "location" => "Quezon City", "specific_location" => "West Ave. corner Quezon Ave, Quezon City, Metro Manila", "location_image" => "/assets/Location/Residences View/One Delta Terraces View.jpg", "lat" => 14.6460, "lng" => 121.0568],
    ["name" => "Prisma Residence", "location" => "Pasig City", "specific_location" => "Pasig Boulevard, Brgy. Bagong Ilog", "location_image" => "/assets/Location/Residences View/Prisma Residence View.png", "lat" => 14.5842, "lng" => 121.0609],
    ["name" => "Sage Residence", "location" => "Mandaluyong City", "specific_location" => "Domingo M. Guevara and Sinag Streets, Mauway, Mandaluyong City", "location_image" => "/assets/Location/Residences View/Sage Residence View.jpg", "lat" => 14.5794, "lng" => 121.0365],
    ["name" => "Satory Residence", "location" => "Pasig City", "specific_location" => "F. Pasco Avenue, Santolan, Pasig City", "location_image" => "/assets/Location/Residences View/Satori Residence View.png", "lat" => 14.5826, "lng" => 121.0664],
    ["name" => "Solmera Coast", "location" => "San Juan, Batangas", "specific_location" => "Brgy. Calubcub II and Brgy. Subukin", "location_image" => "/assets/Location/Residences View/Solmera Coast View.jpg", "lat" => 13.7952, "lng" => 121.0640],
    ["name" => "Sonora Garden Residences", "location" => "Las Pinas", "specific_location" => "Alabang–Zapote Road, Talon Tres, Las Pinas", "location_image" => "/assets/Location/Residences View/Sonora Garden Residences View.jpg", "lat" => 14.4485, "lng" => 120.9940],
    ["name" => "The Atherton", "location" => "Parañaque City", "specific_location" => "Dr. A. Santos Ave., Parañaque City", "location_image" => "/assets/Location/Residences View/The Atherton Views.jpg", "lat" => 14.5083, "lng" => 120.9792],
    ["name" => "The Calinea Tower", "location" => "Caloocan City", "specific_location" => "M.H. Del Pilar St., Grace Park, Caloocan City", "location_image" => "/assets/Location/Residences View/The Calinea Tower View.jpg", "lat" => 14.6502, "lng" => 120.9822],
    ["name" => "The Campden Place", "location" => "Manila", "specific_location" => "Dominga St., Malate, Manila", "location_image" => "/assets/Location/Residences View/The Campden Place View.png", "lat" => 14.5995, "lng" => 120.9842],
    ["name" => "The Crestmont", "location" => "Quezon City", "specific_location" => "Panay Ave., South Triangle, Quezon City", "location_image" => "/assets/Location/Residences View/The Crestmont View.jpg", "lat" => 14.6474, "lng" => 121.0532],
    ["name" => "The Erin Heights", "location" => "Quezon City", "specific_location" => "Commonwealth Ave. corner Tandang Sora Ave., Matandang Balara", "location_image" => "/assets/Location/Residences View/The Erin Heights View.png", "lat" => 14.6467, "lng" => 121.0605],
    ["name" => "The Oriana", "location" => "Quezon City", "specific_location" => "Aurora Blvd, Project 4, Quezon City", "location_image" => "/assets/Location/Residences View/The Oriana View.png", "lat" => 14.6418, "lng" => 121.0582],
    ["name" => "The Valeron Tower","location" => "Pasig City","specific_location" => "C-5 corner P.E. Antonio St., Brgy. Ugong, Pasig City","location_image" => "/assets/Location/Residences View/The Valeron Tower View.jpg","lat" => 14.5833000,"lng" => 121.0597000],

];

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
