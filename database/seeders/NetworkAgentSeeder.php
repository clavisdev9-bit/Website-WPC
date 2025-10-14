<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NetworkAgentSeeder extends Seeder
{
    public function run(): void
    {
        // ==============================
        // COUNTRIES
        // ==============================
        $countries = [
            ['name' => 'Indonesia', 'iso_code' => 'ID'],
            ['name' => 'Japan', 'iso_code' => 'JP'],
            ['name' => 'France', 'iso_code' => 'FR'],
            ['name' => 'USA', 'iso_code' => 'US'],
            ['name' => 'South Africa', 'iso_code' => 'ZA'],
        ];

        DB::table('countries_network_agent')->insert($countries);

        // Ambil ID tiap negara
        $countryIds = DB::table('countries_network_agent')->pluck('id', 'iso_code');

        // ==============================
        // CITIES
        // ==============================
        $cities = [
            // Indonesia
            ['country_id' => $countryIds['ID'], 'name' => 'Jakarta', 'lat' => -6.2088, 'lng' => 106.8456],
            ['country_id' => $countryIds['ID'], 'name' => 'Surabaya', 'lat' => -7.2504, 'lng' => 112.7688],
            ['country_id' => $countryIds['ID'], 'name' => 'Medan', 'lat' => 3.5952, 'lng' => 98.6722],

            // Japan
            ['country_id' => $countryIds['JP'], 'name' => 'Tokyo', 'lat' => 35.6895, 'lng' => 139.6917],

            // France
            ['country_id' => $countryIds['FR'], 'name' => 'Paris', 'lat' => 48.8566, 'lng' => 2.3522],

            // USA
            ['country_id' => $countryIds['US'], 'name' => 'New York', 'lat' => 40.7128, 'lng' => -74.0060],

            // South Africa
            ['country_id' => $countryIds['ZA'], 'name' => 'Cape Town', 'lat' => -33.9249, 'lng' => 18.4241],
        ];

        DB::table('cities_network_agent')->insert($cities);

        // Ambil ID kota
        $cityIds = DB::table('cities_network_agent')->pluck('id', 'name');

        // ==============================
        // AGENTS
        // ==============================
        $agents = [
            // Indonesia
            [
                'name' => 'Jakarta 1',
                'code' => 'ID-JKT-001',
                'country_id' => $countryIds['ID'],
                'city_id' => $cityIds['Jakarta'],
                'address' => 'Jl. Merdeka No.1, Jakarta',
                'lat' => -6.2088,
                'lng' => 106.8456,
                'phone' => '+62 21 555 1111',
                'email' => 'jakarta1@company.com',
                'image' => '/images/branch1.jpg',
                'status' => 'active'
            ],
            [
                'name' => 'Jakarta 2',
                'code' => 'ID-JKT-002',
                'country_id' => $countryIds['ID'],
                'city_id' => $cityIds['Jakarta'],
                'address' => 'Jl. Thamrin No.5, Jakarta',
                'lat' => -6.2170,
                'lng' => 106.8450,
                'phone' => '+62 21 555 2222',
                'email' => 'jakarta2@company.com',
                'image' => '/images/branch2.jpg',
                'status' => 'active'
            ],
            [
                'name' => 'Jakarta 3',
                'code' => 'ID-JKT-003',
                'country_id' => $countryIds['ID'],
                'city_id' => $cityIds['Jakarta'],
                'address' => 'Jl. Sudirman No.8, Jakarta',
                'lat' => -6.2121,
                'lng' => 106.8459,
                'phone' => '+62 21 555 3333',
                'email' => 'jakarta3@company.com',
                'image' => '/images/branch3.jpg',
                'status' => 'active'
            ],

            // Japan
            [
                'name' => 'Tokyo Port',
                'code' => 'JP-TYO-001',
                'country_id' => $countryIds['JP'],
                'city_id' => $cityIds['Tokyo'],
                'address' => 'Chuo-ku, Tokyo',
                'lat' => 35.6895,
                'lng' => 139.6917,
                'phone' => '+81 3 5555 8888',
                'email' => 'tokyo@company.com',
                'image' => '/images/tokyo.jpg',
                'status' => 'active'
            ],

            // France
            [
                'name' => 'Paris Office',
                'code' => 'FR-PAR-001',
                'country_id' => $countryIds['FR'],
                'city_id' => $cityIds['Paris'],
                'address' => 'Rue de Rivoli, Paris',
                'lat' => 48.8566,
                'lng' => 2.3522,
                'phone' => '+33 1 5555 9999',
                'email' => 'paris@company.com',
                'image' => '/images/paris.jpg',
                'status' => 'active'
            ],

            // USA
            [
                'name' => 'New York Branch',
                'code' => 'US-NY-001',
                'country_id' => $countryIds['US'],
                'city_id' => $cityIds['New York'],
                'address' => '5th Avenue, New York',
                'lat' => 40.7128,
                'lng' => -74.0060,
                'phone' => '+1 212 555 7777',
                'email' => 'ny@company.com',
                'image' => '/images/ny.jpg',
                'status' => 'active'
            ],

            // South Africa
            [
                'name' => 'Cape Town Port',
                'code' => 'ZA-CT-001',
                'country_id' => $countryIds['ZA'],
                'city_id' => $cityIds['Cape Town'],
                'address' => 'Dock Road, Cape Town',
                'lat' => -33.9249,
                'lng' => 18.4241,
                'phone' => '+27 21 555 4444',
                'email' => 'capetown@company.com',
                'image' => '/images/capetown.jpg',
                'status' => 'active'
            ],
        ];

        DB::table('agents_network')->insert($agents);
    }
}
