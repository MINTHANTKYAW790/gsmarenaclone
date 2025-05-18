<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Seed Brands
        $brands = [
            ['name' => 'Samsung', 'logo_url' => 'https://via.placeholder.com/150x50?text=Samsung', 'website_url' => 'https://www.samsung.com/'],
            ['name' => 'Apple', 'logo_url' => 'https://via.placeholder.com/150x50?text=Apple', 'website_url' => 'https://www.apple.com/'],
            ['name' => 'Google', 'logo_url' => 'https://via.placeholder.com/150x50?text=Google', 'website_url' => 'https://www.google.com/'],
            ['name' => 'Xiaomi', 'logo_url' => 'https://via.placeholder.com/150x50?text=Xiaomi', 'website_url' => 'https://www.mi.com/'],
            ['name' => 'OnePlus', 'logo_url' => 'https://via.placeholder.com/150x50?text=OnePlus', 'website_url' => 'https://www.oneplus.com/'],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert($brand);
        }

        // Seed Devices
        $devices = [
            [
                'brand_id' => 1,
                'name' => 'Galaxy S23 Ultra',
                'release_date' => '2023-02-01',
                'price' => 1199.99,
                'image_url' => 'https://via.placeholder.com/300x400?text=GalaxyS23',
                'os' => 'Android 13',
                'device_type' => 'phone',
            ],
            [
                'brand_id' => 1,
                'name' => 'Galaxy A54',
                'release_date' => '2023-03-15',
                'price' => 449.99,
                'image_url' => 'https://via.placeholder.com/300x400?text=GalaxyA54',
                'os' => 'Android 13',
                'device_type' => 'phone',
            ],
            [
                'brand_id' => 2,
                'name' => 'iPhone 14 Pro',
                'release_date' => '2022-09-16',
                'price' => 1099.00,
                'image_url' => 'https://via.placeholder.com/300x400?text=iPhone14Pro',
                'os' => 'iOS 16',
                'device_type' => 'phone',
            ],
             [
                'brand_id' => 2,
                'name' => 'iPad Pro 12.9',
                'release_date' => '2022-10-26',
                'price' => 1299.00,
                'image_url' => 'https://via.placeholder.com/400x300?text=iPadPro12.9',
                'os' => 'iPadOS 16',
                'device_type' => 'tablet',
            ],
            [
                'brand_id' => 3,
                'name' => 'Pixel 7',
                'release_date' => '2022-10-13',
                'price' => 599.00,
                'image_url' => 'https://via.placeholder.com/300x400?text=Pixel7',
                'os' => 'Android 13',
                'device_type' => 'phone',
            ],
            [
                'brand_id' => 4,
                'name' => 'Redmi Note 12 Pro',
                'release_date' => '2023-01-05',
                'price' => 329.00,
                'image_url' => 'https://via.placeholder.com/300x400?text=RedmiNote12',
                'os' => 'Android 12',
                'device_type' => 'phone',
            ],
            [
                'brand_id' => 5,
                'name' => 'OnePlus 11',
                'release_date' => '2023-02-07',
                'price' => 699.00,
                'image_url' => 'https://via.placeholder.com/300x400?text=OnePlus11',
                'os' => 'Android 13',
                'device_type' => 'phone',
            ],
             [
                'brand_id' => 2,
                'name' => 'Apple Watch Series 8',
                'release_date' => '2022-09-16',
                'price' => 399.00,
                'image_url' => 'https://via.placeholder.com/300x400?text=AppleWatchS8',
                'os' => 'watchOS 9',
                'device_type' => 'smartwatch'
            ],
        ];

        foreach ($devices as $device) {
            DB::table('devices')->insert($device);
        }

        // Seed Spec Categories
        $specCategories = [
            ['name' => 'Display'],
            ['name' => 'Camera'],
            ['name' => 'Battery'],
            ['name' => 'Processor'],
            ['name' => 'Memory'],
            ['name' => 'Body'],
            ['name' => 'Network'],
        ];

        foreach ($specCategories as $category) {
            DB::table('spec_categories')->insert($category);
        }

        // Seed Specs
        $specs = [
            // Samsung Galaxy S23 Ultra Specs
            [
                'device_id' => 1, 'spec_category_id' => 1, 'key' => 'Size', 'value' => '6.8 inches',
            ],
            [
                'device_id' => 1, 'spec_category_id' => 1, 'key' => 'Resolution', 'value' => '1440 x 3088 pixels',
            ],
            [
                'device_id' => 1, 'spec_category_id' => 2, 'key' => 'Main Camera', 'value' => '200 MP',
            ],
             [
                'device_id' => 1, 'spec_category_id' => 2, 'key' => 'Front Camera', 'value' => '12 MP',
            ],
            [
                'device_id' => 1, 'spec_category_id' => 3, 'key' => 'Capacity', 'value' => '5000 mAh',
            ],
            [
                'device_id' => 1, 'spec_category_id' => 4, 'key' => 'Chipset', 'value' => 'Snapdragon 8 Gen 2',
            ],
            [
                'device_id' => 1, 'spec_category_id' => 5, 'key' => 'RAM', 'value' => '8 GB',
            ],
            [
                'device_id' => 1, 'spec_category_id' => 5, 'key' => 'Storage', 'value' => '256 GB',
            ],
             [
                'device_id' => 1, 'spec_category_id' => 6, 'key' => 'Dimensions', 'value' => '163.4 x 78.1 x 8.9 mm',
            ],
            [
                'device_id' => 1, 'spec_category_id' => 7, 'key' => 'Network', 'value' => '5G',
            ],

            // Samsung Galaxy A54 Specs
            [
                'device_id' => 2, 'spec_category_id' => 1, 'key' => 'Size', 'value' => '6.4 inches',
            ],
            [
                'device_id' => 2, 'spec_category_id' => 1, 'key' => 'Resolution', 'value' => '1080 x 2400 pixels',
            ],
            [
                'device_id' => 2, 'spec_category_id' => 2, 'key' => 'Main Camera', 'value' => '50 MP',
            ],
            [
                'device_id' => 2, 'spec_category_id' => 2, 'key' => 'Front Camera', 'value' => '32 MP',
            ],
            [
                'device_id' => 2, 'spec_category_id' => 3, 'key' => 'Capacity', 'value' => '5000 mAh',
            ],
            [
                'device_id' => 2, 'spec_category_id' => 4, 'key' => 'Chipset', 'value' => 'Exynos 1380',
            ],
            [
                'device_id' => 2, 'spec_category_id' => 5, 'key' => 'RAM', 'value' => '6 GB',
            ],
            [
                'device_id' => 2, 'spec_category_id' => 5, 'key' => 'Storage', 'value' => '128 GB',
            ],
            [
                'device_id' => 2, 'spec_category_id' => 6, 'key' => 'Dimensions', 'value' => '158.2 x 76.7 x 8.2 mm',
            ],
             [
                'device_id' => 2, 'spec_category_id' => 7, 'key' => 'Network', 'value' => '5G',
            ],

            // iPhone 14 Pro Specs
            [
                'device_id' => 3, 'spec_category_id' => 1, 'key' => 'Size', 'value' => '6.1 inches',
            ],
            [
                'device_id' => 3, 'spec_category_id' => 1, 'key' => 'Resolution', 'value' => '1179 x 2556 pixels',
            ],
            [
                 'device_id' => 3, 'spec_category_id' => 2, 'key' => 'Main Camera', 'value' => '48 MP',
            ],
            [
                'device_id' => 3, 'spec_category_id' => 2, 'key' => 'Front Camera', 'value' => '12 MP',
            ],
            [
                'device_id' => 3, 'spec_category_id' => 3, 'key' => 'Capacity', 'value' => '3200 mAh',
            ],
            [
                'device_id' => 3, 'spec_category_id' => 4, 'key' => 'Chipset', 'value' => 'Apple A16 Bionic',
            ],
            [
                'device_id' => 3, 'spec_category_id' => 5, 'key' => 'RAM', 'value' => '6 GB',
            ],
            [
                'device_id' => 3, 'spec_category_id' => 5, 'key' => 'Storage', 'value' => '256 GB',
            ],
            [
                'device_id' => 3, 'spec_category_id' => 6, 'key' => 'Dimensions', 'value' => '147.5 x 71.5 x 7.9 mm',
            ],
            [
                'device_id' => 3, 'spec_category_id' => 7, 'key' => 'Network', 'value' => '5G',
            ],

             // iPad Pro 12.9 Specs
             [
                'device_id' => 4, 'spec_category_id' => 1, 'key' => 'Size', 'value' => '12.9 inches',
            ],
            [
                'device_id' => 4, 'spec_category_id' => 1, 'key' => 'Resolution', 'value' => '2732 x 2048 pixels',
            ],
            [
                'device_id' => 4, 'spec_category_id' => 2, 'key' => 'Main Camera', 'value' => '12 MP',
            ],
            [
                'device_id' => 4, 'spec_category_id' => 2, 'key' => 'Front Camera', 'value' => '12 MP',
            ],
            [
                'device_id' => 4, 'spec_category_id' => 3, 'key' => 'Capacity', 'value' => '40.88 Wh',
            ],
            [
                'device_id' => 4, 'spec_category_id' => 4, 'key' => 'Chipset', 'value' => 'Apple M2',
            ],
            [
                'device_id' => 4, 'spec_category_id' => 5, 'key' => 'RAM', 'value' => '8 GB',
            ],
            [
                'device_id' => 4, 'spec_category_id' => 5, 'key' => 'Storage', 'value' => '256 GB',
            ],
            [
                'device_id' => 4, 'spec_category_id' => 6, 'key' => 'Dimensions', 'value' => '280.6 x 214.9 x 6.4 mm',
            ],
            [
                'device_id' => 4, 'spec_category_id' => 7, 'key' => 'Network', 'value' => '5G (optional)',
            ],

            // Google Pixel 7 Specs
            [
                'device_id' => 5, 'spec_category_id' => 1, 'key' => 'Size', 'value' => '6.3 inches',
            ],
            [
                'device_id' => 5, 'spec_category_id' => 1, 'key' => 'Resolution', 'value' => '1080 x 2400 pixels',
            ],
            [
                'device_id' => 5, 'spec_category_id' => 2, 'key' => 'Main Camera', 'value' => '50 MP',
            ],
            [
                'device_id' => 5, 'spec_category_id' => 2, 'key' => 'Front Camera', 'value' => '10.8 MP',
            ],
            [
                'device_id' => 5, 'spec_category_id' => 3, 'key' => 'Capacity', 'value' => '4355 mAh',
            ],
            [
                'device_id' => 5, 'spec_category_id' => 4, 'key' => 'Chipset', 'value' => 'Google Tensor G2',
            ],
            [
                'device_id' => 5, 'spec_category_id' => 5, 'key' => 'RAM', 'value' => '8 GB',
            ],
            [
                'device_id' => 5, 'spec_category_id' => 5, 'key' => 'Storage', 'value' => '128 GB',
            ],
            [
                'device_id' => 5, 'spec_category_id' => 6, 'key' => 'Dimensions', 'value' => '155.6 x 73.2 x 8.7 mm',
            ],
            [
                'device_id' => 5, 'spec_category_id' => 7, 'key' => 'Network', 'value' => '5G',
            ],

            // Xiaomi Redmi Note 12 Pro Specs
            [
                'device_id' => 6, 'spec_category_id' => 1, 'key' => 'Size', 'value' => '6.67 inches',
            ],
            [
                'device_id' => 6, 'spec_category_id' => 1, 'key' => 'Resolution', 'value' => '1080 x 2400 pixels',
            ],
            [
                'device_id' => 6, 'spec_category_id' => 2, 'key' => 'Main Camera', 'value' => '50 MP',
            ],
            [
                'device_id' => 6, 'spec_category_id' => 2, 'key' => 'Front Camera', 'value' => '16 MP',
            ],
            [
                'device_id' => 6, 'spec_category_id' => 3, 'key' => 'Capacity', 'value' => '5000 mAh',
            ],
            [
                'device_id' => 6, 'spec_category_id' => 4, 'key' => 'Chipset', 'value' => 'Snapdragon 732G',
            ],
            [
                'device_id' => 6, 'spec_category_id' => 5, 'key' => 'RAM', 'value' => '6 GB',
            ],
            [
                'device_id' => 6, 'spec_category_id' => 5, 'key' => 'Storage', 'value' => '128 GB',
            ],
            [
                'device_id' => 6, 'spec_category_id' => 6, 'key' => 'Dimensions', 'value' => '164.2 x 76.1 x 8.1 mm',
            ],
            [
                'device_id' => 6, 'spec_category_id' => 7, 'key' => 'Network', 'value' => '4G',
            ],

            // OnePlus 11 Specs
            [
                'device_id' => 7, 'spec_category_id' => 1, 'key' => 'Size', 'value' => '6.7 inches',
            ],
            [
                'device_id' => 7, 'spec_category_id' => 1, 'key' => 'Resolution', 'value' => '1440 x 3216 pixels',
            ],
            [
                'device_id' => 7, 'spec_category_id' => 2, 'key' => 'Main Camera', 'value' => '50 MP',
            ],
            [
                'device_id' => 7, 'spec_category_id' => 2, 'key' => 'Front Camera', 'value' => '16 MP',
            ],
            [
                'device_id' => 7, 'spec_category_id' => 3, 'key' => 'Capacity', 'value' => '5000 mAh',
            ],
            [
                'device_id' => 7, 'spec_category_id' => 4, 'key' => 'Chipset', 'value' => 'Snapdragon 8 Gen 2',
            ],
            [
                'device_id' => 7, 'spec_category_id' => 5, 'key' => 'RAM', 'value' => '8 GB',
            ],
            [
                'device_id' => 7, 'spec_category_id' => 5, 'key' => 'Storage', 'value' => '128 GB',
            ],
            [
                'device_id' => 7, 'spec_category_id' => 6, 'key' => 'Dimensions', 'value' => '163.1 x 74.1 x 8.5 mm',
            ],
            [
                'device_id' => 7, 'spec_category_id' => 7, 'key' => 'Network', 'value' => '5G',
            ],

            // Apple Watch Series 8
            [
                'device_id' => 8,
                'spec_category_id' => 1,
                'key' => 'Display Type',
                'value' => 'Retina LTPO OLED',
            ],
            [
                'device_id' => 8,
                'spec_category_id' => 1,
                'key' => 'Size',
                'value' => '1.9 inches',
            ],
            [
                'device_id' => 8,
                'spec_category_id' => 1,
                'key' => 'Resolution',
                'value' => '484 x 396 pixels',
            ],
            [
                'device_id' => 8,
                'spec_category_id' => 4,
                'key' => 'Chipset',
                'value' => 'Apple S8',
            ],
            [
                'device_id' => 8,
                'spec_category_id' => 5,
                'key' => 'Storage',
                'value' => '32 GB',
            ],
            [
                'device_id' => 8,
                'spec_category_id' => 6,
                'key' => 'Dimensions',
                'value' => '45 x 38 x 10.7 mm',
            ],
            [
                'device_id' => 8,
                'spec_category_id' => 7,
                'key' => 'Network',
                'value' => 'Wi-Fi, Bluetooth, Cellular (optional)',
            ],
            [
                'device_id' => 8,
                'spec_category_id' => 3,
                'key' => 'Battery Life',
                'value' => 'Up to 18 hours',
            ],
        ];

        foreach ($specs as $spec) {
            DB::table('specs')->insert($spec);
        }
    }
}
