<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $devices = [
            [
                'brand_name' => 'Samsung',
                'name' => 'Samsung Galaxy S24 Ultra',
                'model_number' => 'SM-S928B',
                'release_date' => '2024-01-17',
                'image_url' => 'https://fdn2.gsmarena.com/vv/bigpic/samsung-galaxy-s24-ultra-5g.jpg',
            ],
            [
                'brand_name' => 'Apple',
                'name' => 'Apple iPhone 15 Pro Max',
                'model_number' => 'A2849',
                'release_date' => '2023-09-22',
                'image_url' => 'https://fdn2.gsmarena.com/vv/bigpic/apple-iphone-15-pro-max.jpg',
            ],
            [
                'brand_name' => 'Xiaomi',
                'name' => 'Xiaomi 14 Ultra',
                'model_number' => '24030PN60G',
                'release_date' => '2024-02-22',
                'image_url' => 'https://fdn2.gsmarena.com/vv/bigpic/xiaomi-14-ultra.jpg',
            ],
        ];

        foreach ($devices as $deviceData) {
            $brand = Brand::where('name', $deviceData['brand_name'])->first();

            if ($brand) {
                Device::create([
                    'brand_id' => $brand->id,
                    'name' => $deviceData['name'],
                    'model_number' => $deviceData['model_number'],
                    'release_date' => $deviceData['release_date'],
                    'image_url' => $deviceData['image_url'],
                ]);
            }
        }
    }
}
