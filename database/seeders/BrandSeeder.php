<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
   /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Samsung',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/2/24/Samsung_Logo.svg',
                'website_url' => 'https://www.samsung.com/',
            ],
            [
                'name' => 'Apple',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg',
                'website_url' => 'https://www.apple.com/',
            ],
            [
                'name' => 'Xiaomi',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/2/29/Xiaomi_logo.svg',
                'website_url' => 'https://www.mi.com/',
            ],
            [
                'name' => 'OnePlus',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/f/f5/OnePlus_logo.svg',
                'website_url' => 'https://www.oneplus.com/',
            ],
            [
                'name' => 'Google',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg',
                'website_url' => 'https://store.google.com/',
            ],
            [
                'name' => 'Oppo',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/1/13/OPPO_LOGO_2019.svg',
                'website_url' => 'https://www.oppo.com/',
            ],
            [
                'name' => 'Vivo',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/6/60/Vivo_logo_2020.svg',
                'website_url' => 'https://www.vivo.com/',
            ],
            [
                'name' => 'Sony',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/2/2e/Sony_logo.svg',
                'website_url' => 'https://www.sony.com/',
            ],
            [
                'name' => 'Motorola',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/b/bd/Motorola_logo.svg',
                'website_url' => 'https://www.motorola.com/',
            ],
            [
                'name' => 'Realme',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/7/70/Realme_logo.svg',
                'website_url' => 'https://www.realme.com/',
            ],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
