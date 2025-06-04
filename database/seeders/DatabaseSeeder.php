<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Seed Brands
        $brands = [
            ['name' => 'Dell', 'logo_url' => 'https://via.placeholder.com/150x50?text=Dell', 'website_url' => 'https://www.dell.com/'],
            ['name' => 'Apple', 'logo_url' => 'https://via.placeholder.com/150x50?text=Apple', 'website_url' => 'https://www.apple.com/'],
            ['name' => 'HP', 'logo_url' => 'https://via.placeholder.com/150x50?text=HP', 'website_url' => 'https://www.hp.com/'],
            ['name' => 'Lenovo', 'logo_url' => 'https://via.placeholder.com/150x50?text=Lenovo', 'website_url' => 'https://www.lenovo.com/'],
            ['name' => 'Asus', 'logo_url' => 'https://via.placeholder.com/150x50?text=Asus', 'website_url' => 'https://www.asus.com/'],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert($brand);
        }

        // Seed Devices
        $devices = [
            [
                'brand_id' => 1,
                'name' => 'XPS 13 Plus',
                'release_date' => '2023-01-10',
                'price' => 1399.99,
                'image_url' => 'https://via.placeholder.com/300x400?text=XPS13Plus',
                'os' => 'Windows 11',
                'device_type' => 'laptop',
            ],
            [
                'brand_id' => 2,
                'name' => 'MacBook Pro 16"',
                'release_date' => '2023-02-01',
                'price' => 2499.00,
                'image_url' => 'https://via.placeholder.com/300x400?text=MacBookPro16',
                'os' => 'macOS Ventura',
                'device_type' => 'laptop',
            ],
            [
                'brand_id' => 3,
                'name' => 'Spectre x360 14',
                'release_date' => '2023-03-15',
                'price' => 1599.00,
                'image_url' => 'https://via.placeholder.com/300x400?text=Spectrex360',
                'os' => 'Windows 11',
                'device_type' => 'laptop',
            ],
            [
                'brand_id' => 4,
                'name' => 'ThinkPad X1 Carbon Gen 11',
                'release_date' => '2023-04-01',
                'price' => 1799.00,
                'image_url' => 'https://via.placeholder.com/300x400?text=ThinkPadX1',
                'os' => 'Windows 11',
                'device_type' => 'laptop',
            ],
            [
                'brand_id' => 5,
                'name' => 'ZenBook 14 OLED',
                'release_date' => '2023-05-10',
                'price' => 1299.00,
                'image_url' => 'https://via.placeholder.com/300x400?text=ZenBook14',
                'os' => 'Windows 11',
                'device_type' => 'laptop',
            ],
        ];

        foreach ($devices as $device) {
            DB::table('devices')->insert($device);
        }

        // Seed Spec Categories
        $specCategories = [
            ['name' => 'Display'],
            ['name' => 'Processor'],
            ['name' => 'Memory'],
            ['name' => 'Storage'],
            ['name' => 'Graphics'],
            ['name' => 'Battery'],
            ['name' => 'Body'],
            ['name' => 'Ports'],
            ['name' => 'Network'],
        ];

        foreach ($specCategories as $category) {
            DB::table('spec_categories')->insert($category);
        }

        // Seed Specs
        $specs = [
            // Dell XPS 13 Plus
            ['device_id' => 1, 'spec_category_id' => 1, 'key' => 'Size', 'value' => '13.4 inches'],
            ['device_id' => 1, 'spec_category_id' => 1, 'key' => 'Resolution', 'value' => '3840 x 2400'],
            ['device_id' => 1, 'spec_category_id' => 2, 'key' => 'CPU', 'value' => 'Intel Core i7-1360P'],
            ['device_id' => 1, 'spec_category_id' => 3, 'key' => 'RAM', 'value' => '16 GB'],
            ['device_id' => 1, 'spec_category_id' => 4, 'key' => 'Storage', 'value' => '512 GB SSD'],
            ['device_id' => 1, 'spec_category_id' => 5, 'key' => 'GPU', 'value' => 'Intel Iris Xe'],
            ['device_id' => 1, 'spec_category_id' => 6, 'key' => 'Battery', 'value' => '55 Wh'],
            ['device_id' => 1, 'spec_category_id' => 7, 'key' => 'Weight', 'value' => '1.26 kg'],
            ['device_id' => 1, 'spec_category_id' => 8, 'key' => 'Ports', 'value' => '2x Thunderbolt 4'],
            ['device_id' => 1, 'spec_category_id' => 9, 'key' => 'Wi-Fi', 'value' => 'Wi-Fi 6E'],

            // MacBook Pro 16"
            ['device_id' => 2, 'spec_category_id' => 1, 'key' => 'Size', 'value' => '16.2 inches'],
            ['device_id' => 2, 'spec_category_id' => 1, 'key' => 'Resolution', 'value' => '3456 x 2234'],
            ['device_id' => 2, 'spec_category_id' => 2, 'key' => 'CPU', 'value' => 'Apple M2 Pro'],
            ['device_id' => 2, 'spec_category_id' => 3, 'key' => 'RAM', 'value' => '16 GB'],
            ['device_id' => 2, 'spec_category_id' => 4, 'key' => 'Storage', 'value' => '512 GB SSD'],
            ['device_id' => 2, 'spec_category_id' => 5, 'key' => 'GPU', 'value' => 'Apple M2 Pro GPU'],
            ['device_id' => 2, 'spec_category_id' => 6, 'key' => 'Battery', 'value' => '100 Wh'],
            ['device_id' => 2, 'spec_category_id' => 7, 'key' => 'Weight', 'value' => '2.15 kg'],
            ['device_id' => 2, 'spec_category_id' => 8, 'key' => 'Ports', 'value' => '3x Thunderbolt 4, HDMI, SDXC'],
            ['device_id' => 2, 'spec_category_id' => 9, 'key' => 'Wi-Fi', 'value' => 'Wi-Fi 6E'],

            // HP Spectre x360 14
            ['device_id' => 3, 'spec_category_id' => 1, 'key' => 'Size', 'value' => '13.5 inches'],
            ['device_id' => 3, 'spec_category_id' => 1, 'key' => 'Resolution', 'value' => '3000 x 2000'],
            ['device_id' => 3, 'spec_category_id' => 2, 'key' => 'CPU', 'value' => 'Intel Core i7-1355U'],
            ['device_id' => 3, 'spec_category_id' => 3, 'key' => 'RAM', 'value' => '16 GB'],
            ['device_id' => 3, 'spec_category_id' => 4, 'key' => 'Storage', 'value' => '1 TB SSD'],
            ['device_id' => 3, 'spec_category_id' => 5, 'key' => 'GPU', 'value' => 'Intel Iris Xe'],
            ['device_id' => 3, 'spec_category_id' => 6, 'key' => 'Battery', 'value' => '66 Wh'],
            ['device_id' => 3, 'spec_category_id' => 7, 'key' => 'Weight', 'value' => '1.36 kg'],
            ['device_id' => 3, 'spec_category_id' => 8, 'key' => 'Ports', 'value' => '2x Thunderbolt 4, USB-A, microSD'],
            ['device_id' => 3, 'spec_category_id' => 9, 'key' => 'Wi-Fi', 'value' => 'Wi-Fi 6E'],

            // Lenovo ThinkPad X1 Carbon Gen 11
            ['device_id' => 4, 'spec_category_id' => 1, 'key' => 'Size', 'value' => '14 inches'],
            ['device_id' => 4, 'spec_category_id' => 1, 'key' => 'Resolution', 'value' => '2880 x 1800'],
            ['device_id' => 4, 'spec_category_id' => 2, 'key' => 'CPU', 'value' => 'Intel Core i7-1370P'],
            ['device_id' => 4, 'spec_category_id' => 3, 'key' => 'RAM', 'value' => '16 GB'],
            ['device_id' => 4, 'spec_category_id' => 4, 'key' => 'Storage', 'value' => '1 TB SSD'],
            ['device_id' => 4, 'spec_category_id' => 5, 'key' => 'GPU', 'value' => 'Intel Iris Xe'],
            ['device_id' => 4, 'spec_category_id' => 6, 'key' => 'Battery', 'value' => '57 Wh'],
            ['device_id' => 4, 'spec_category_id' => 7, 'key' => 'Weight', 'value' => '1.12 kg'],
            ['device_id' => 4, 'spec_category_id' => 8, 'key' => 'Ports', 'value' => '2x Thunderbolt 4, 2x USB-A, HDMI'],
            ['device_id' => 4, 'spec_category_id' => 9, 'key' => 'Wi-Fi', 'value' => 'Wi-Fi 6E'],

            // Asus ZenBook 14 OLED
            ['device_id' => 5, 'spec_category_id' => 1, 'key' => 'Size', 'value' => '14 inches'],
            ['device_id' => 5, 'spec_category_id' => 1, 'key' => 'Resolution', 'value' => '2880 x 1800'],
            ['device_id' => 5, 'spec_category_id' => 2, 'key' => 'CPU', 'value' => 'AMD Ryzen 7 7730U'],
            ['device_id' => 5, 'spec_category_id' => 3, 'key' => 'RAM', 'value' => '16 GB'],
            ['device_id' => 5, 'spec_category_id' => 4, 'key' => 'Storage', 'value' => '1 TB SSD'],
            ['device_id' => 5, 'spec_category_id' => 5, 'key' => 'GPU', 'value' => 'AMD Radeon Graphics'],
            ['device_id' => 5, 'spec_category_id' => 6, 'key' => 'Battery', 'value' => '75 Wh'],
            ['device_id' => 5, 'spec_category_id' => 7, 'key' => 'Weight', 'value' => '1.39 kg'],
            ['device_id' => 5, 'spec_category_id' => 8, 'key' => 'Ports', 'value' => '2x USB-C, HDMI, USB-A, microSD'],
            ['device_id' => 5, 'spec_category_id' => 9, 'key' => 'Wi-Fi', 'value' => 'Wi-Fi 6E'],
        ];

        foreach ($specs as $spec) {
            DB::table('specs')->insert($spec);
        }
    }
}
