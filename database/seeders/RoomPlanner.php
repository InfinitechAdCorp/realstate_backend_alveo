<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomPlanner extends Seeder
{

      public function run(): void
    {
        DB::table('roomplanner')->insert([
            ['name' => 'Sofas', 'picture' => '1132423705.png', 'width' => 228.60, 'height' => 99.06, 'category' => 'Living Room', 'created_at' => '2024-10-06 06:48:10', 'updated_at' => '2024-10-06 06:48:10'],
            ['name' => 'Loveseats', 'picture' => '1243345615.png', 'width' => 167.64, 'height' => 96.52, 'category' => 'Living Room', 'created_at' => '2024-10-06 06:50:29', 'updated_at' => '2024-10-06 06:50:29'],
            ['name' => 'Reclining Sofas', 'picture' => '1174906435.png', 'width' => 241.30, 'height' => 101.60, 'category' => 'Living Room', 'created_at' => '2024-10-06 06:51:15', 'updated_at' => '2024-10-06 06:51:15'],
            ['name' => 'Rocker Recliner', 'picture' => '1745177693.png', 'width' => 99.06, 'height' => 99.06, 'category' => 'Living Room', 'created_at' => '2024-10-06 06:51:57', 'updated_at' => '2024-10-06 06:51:57'],
            ['name' => 'Wing Chairs', 'picture' => '2124960037.png', 'width' => 81.28, 'height' => 88.90, 'category' => 'Living Room', 'created_at' => '2024-10-06 06:52:47', 'updated_at' => '2024-10-06 06:52:47'],
            ['name' => 'Bunk Beds', 'picture' => '9486650.png', 'width' => 193.04, 'height' => 142.24, 'category' => 'Bedroom', 'created_at' => '2024-10-06 06:54:46', 'updated_at' => '2024-10-06 06:54:46'],
            ['name' => 'Nightstands', 'picture' => '215817956.png', 'width' => 66.04, 'height' => 45.72, 'category' => 'Bedroom', 'created_at' => '2024-10-06 06:55:57', 'updated_at' => '2024-10-06 06:55:57'],
            ['name' => 'Panel Beds', 'picture' => '771289725.png', 'width' => 160.02, 'height' => 210.82, 'category' => 'Bedroom', 'created_at' => '2024-10-06 06:57:21', 'updated_at' => '2024-10-06 06:57:21'],
            ['name' => 'Poster Beds', 'picture' => '1980902233.png', 'width' => 182.88, 'height' => 218.44, 'category' => 'Bedroom', 'created_at' => '2024-10-06 06:58:19', 'updated_at' => '2024-10-06 06:58:19'],
            ['name' => 'Sleigh Beds', 'picture' => '1337412148.png', 'width' => 170.18, 'height' => 228.60, 'category' => 'Bedroom', 'created_at' => '2024-10-06 06:59:04', 'updated_at' => '2024-10-06 06:59:04'],
            ['name' => 'Dining Arm Chairs', 'picture' => '1595380367.png', 'width' => 63.50, 'height' => 60.96, 'category' => 'Dining Room', 'created_at' => '2024-10-06 07:03:19', 'updated_at' => '2024-10-06 07:03:19'],
            ['name' => 'Dining Side Chairs', 'picture' => '396017649.png', 'width' => 50.80, 'height' => 55.80, 'category' => 'Dining Room', 'created_at' => '2024-10-06 07:04:10', 'updated_at' => '2024-10-06 08:06:22'],
            ['name' => 'Dining Tables', 'picture' => '1781466465.png', 'width' => 134.62, 'height' => 147.32, 'category' => 'Dining Room', 'created_at' => '2024-10-06 07:05:08', 'updated_at' => '2024-10-06 07:05:08'],
            ['name' => 'Pub Tables', 'picture' => '2126708219.png', 'width' => 114.30, 'height' => 119.38, 'category' => 'Dining Room', 'created_at' => '2024-10-06 07:05:50', 'updated_at' => '2024-10-06 07:05:50'],
            ['name' => 'Servers', 'picture' => '202785245.png', 'width' => 307.34, 'height' => 50.80, 'category' => 'Dining Room', 'created_at' => '2024-10-06 07:06:26', 'updated_at' => '2024-10-06 07:06:26'],
             ['name' => 'Closed Bookcases', 'picture' => '1202722276.png', 'width' => 101.60, 'height' => 40.64, 'category' => 'Home Office', 'created_at' => '2024-10-06 07:07:48', 'updated_at' => '2024-10-06 07:07:48'],
            ['name' => 'Desk Hutch Sets', 'picture' => '116396946.png', 'width' => 139.70, 'height' => 63.50, 'category' => 'Home Office', 'created_at' => '2024-10-06 07:09:01', 'updated_at' => '2024-10-06 07:09:01'],
            ['name' => 'Open Bookcases', 'picture' => '362099337.png', 'width' => 86.36, 'height' => 35.56, 'category' => 'Home Office', 'created_at' => '2024-10-06 07:09:43', 'updated_at' => '2024-10-06 07:09:43'],
            ['name' => 'Single Pedestal Desks', 'picture' => '530986763.png', 'width' => 124.46, 'height' => 55.88, 'category' => 'Home Office', 'created_at' => '2024-10-06 07:10:50', 'updated_at' => '2024-10-06 07:10:50'],
            ['name' => 'Table Desks', 'picture' => '847214268.png', 'width' => 127.00, 'height' => 66.04, 'category' => 'Home Office', 'created_at' => '2024-10-06 07:11:28', 'updated_at' => '2024-10-06 07:11:28'],
['name' => 'Rugs', 'picture' => '263639812.png', 'width' => 228.60, 'height' => 154.94, 'category' => 'Miscellaneous', 'created_at' => '2024-10-06 07:12:04', 'updated_at' => '2024-10-06 07:12:04'],
            ['name' => 'Door Opens Left', 'picture' => '2062599889.png', 'width' => 91.44, 'height' => 70.00, 'category' => 'Structural', 'created_at' => '2024-10-06 07:13:43', 'updated_at' => '2024-10-06 08:03:37'],
            ['name' => 'Door Opens Right', 'picture' => '366401021.png', 'width' => 91.44, 'height' => 70.00, 'category' => 'Structural', 'created_at' => '2024-10-06 07:13:58', 'updated_at' => '2024-10-06 08:03:56'],
            ['name' => 'French Doors', 'picture' => '1861061313.png', 'width' => 203.20, 'height' => 91.44, 'category' => 'Structural', 'created_at' => '2024-10-06 07:15:03', 'updated_at' => '2024-10-06 07:15:03'],
            ['name' => 'Fireplace', 'picture' => '23175773.png', 'width' => 132.08, 'height' => 22.86, 'category' => 'Structural', 'created_at' => '2024-10-06 07:15:48', 'updated_at' => '2024-10-06 07:15:48'],
            ['name' => 'Sliding Doors', 'picture' => '652179417.png', 'width' => 203.20, 'height' => 12.70, 'category' => 'Structural', 'created_at' => '2024-10-06 07:16:36', 'updated_at' => '2024-10-06 07:16:36'],
            ['name' => 'Window', 'picture' => '1210572537.png', 'width' => 139.70, 'height' => 7.62, 'category' => 'Structural', 'created_at' => '2024-10-06 07:17:14', 'updated_at' => '2024-10-06 07:17:14'],
            ['name' => 'Toilets', 'picture' => '596380351.png', 'width' => 30.50, 'height' => 73.50, 'category' => 'Bathroom', 'created_at' => '2024-10-06 07:36:02', 'updated_at' => '2024-10-06 07:36:02'],
            ['name' => 'Pedestal Sinks', 'picture' => '178413739.png', 'width' => 55.80, 'height' => 87.00, 'category' => 'Bathroom', 'created_at' => '2024-10-06 07:42:14', 'updated_at' => '2024-10-06 07:42:14'],
 ['name' => 'Bathtubs', 'picture' => '1375049375.png', 'width' => 170.00, 'height' => 75.00, 'category' => 'Bathroom', 'created_at' => '2024-10-06 07:44:11', 'updated_at' => '2024-10-06 07:44:11'],
            ['name' => 'Ovens', 'picture' => '768782455.png', 'width' => 91.40, 'height' => 95.30, 'category' => 'Kitchen', 'created_at' => '2024-10-06 07:49:13', 'updated_at' => '2024-10-06 07:52:56'],
            ['name' => 'Sinks', 'picture' => '674100858.png', 'width' => 106.30, 'height' => 50.80, 'category' => 'Kitchen', 'created_at' => '2024-10-06 07:54:11', 'updated_at' => '2024-10-06 07:54:11'],
            ['name' => 'Refrigerators', 'picture' => '540764304.png', 'width' => 60.96, 'height' => 152.40, 'category' => 'Kitchen', 'created_at' => '2024-10-06 07:55:33', 'updated_at' => '2024-10-06 07:58:10'],
            ['name' => 'Partitions', 'picture' => '141703244.png', 'width' => 100.00, 'height' => 7.62, 'category' => 'Structural', 'created_at' => '2024-10-06 08:00:35', 'updated_at' => '2024-10-06 08:01:51'],
            ['name' => 'Queen Beds', 'picture' => '254019203.jpg', 'width' => 152.00, 'height' => 190.00, 'category' => 'Bedroom', 'created_at' => '2024-10-06 09:12:38', 'updated_at' => '2024-10-06 09:27:28'],
            ['name' => 'King Beds', 'picture' => '633048086.jpg', 'width' => 182.00, 'height' => 198.00, 'category' => 'Bedroom', 'created_at' => '2024-10-06 09:14:53', 'updated_at' => '2024-10-06 09:28:08'],
            ['name' => 'Double Beds', 'picture' => '122449278.jpg', 'width' => 120.00, 'height' => 190.00, 'category' => 'Bedroom', 'created_at' => '2024-10-06 09:16:30', 'updated_at' => '2024-10-06 09:28:31'],
            ['name' => 'Single Beds', 'picture' => '840872244.jpg', 'width' => 91.00, 'height' => 190.00, 'category' => 'Bedroom', 'created_at' => '2024-10-06 09:19:51', 'updated_at' => '2024-10-06 09:27:43'],
            ['name' => 'Twin Beds', 'picture' => '428510373.jpg', 'width' => 96.52, 'height' => 190.00, 'category' => 'Bedroom', 'created_at' => '2024-10-06 09:24:12', 'updated_at' => '2024-10-06 09:30:21'],



        ]);
    }
}
