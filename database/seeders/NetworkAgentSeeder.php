<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NetworkAgentSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // ====================================
        // SUBCONTINENTS (ambil ID-nya dulu)
        // ====================================
        $subcontinentIds = DB::table('subcontinents_network_agent')->pluck('id', 'code');

        // ====================================
        // COUNTRIES (update: tambah subcontinent_id)
        // ====================================
        $countries = [
            ['name' => 'Indonesia', 'iso_code' => 'ID', 'flag' => 'defaultFlag.png', 'subcontinent_id' => $subcontinentIds['SEA'] ?? 1, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Japan', 'iso_code' => 'JP', 'flag' => 'defaultFlag.png', 'subcontinent_id' => $subcontinentIds['EAS'] ?? 2, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'France', 'iso_code' => 'FR', 'flag' => 'defaultFlag.png', 'subcontinent_id' => $subcontinentIds['WEU'] ?? 5, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'USA', 'iso_code' => 'US', 'flag' => 'defaultFlag.png', 'subcontinent_id' => $subcontinentIds['NA'] ?? 9, 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'South Africa', 'iso_code' => 'ZA', 'flag' => 'defaultFlag.png', 'subcontinent_id' => $subcontinentIds['SSA'] ?? 8, 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('countries_network_agent')->insert($countries);

        // ====================================
        // Ambil ID negara
        // ====================================
        $countryIds = DB::table('countries_network_agent')->pluck('id', 'iso_code');

        // ====================================
        // CITIES
        // ====================================
        $cities = [
            ['country_id' => $countryIds['ID'], 'name' => 'Jakarta', 'lat' => -6.2088, 'lng' => 106.8456, 'created_at' => $now, 'updated_at' => $now],
            ['country_id' => $countryIds['ID'], 'name' => 'Surabaya', 'lat' => -7.2504, 'lng' => 112.7688, 'created_at' => $now, 'updated_at' => $now],
            ['country_id' => $countryIds['ID'], 'name' => 'Medan', 'lat' => 3.5952, 'lng' => 98.6722, 'created_at' => $now, 'updated_at' => $now],
            ['country_id' => $countryIds['JP'], 'name' => 'Tokyo', 'lat' => 35.6895, 'lng' => 139.6917, 'created_at' => $now, 'updated_at' => $now],
            ['country_id' => $countryIds['FR'], 'name' => 'Paris', 'lat' => 48.8566, 'lng' => 2.3522, 'created_at' => $now, 'updated_at' => $now],
            ['country_id' => $countryIds['US'], 'name' => 'New York', 'lat' => 40.7128, 'lng' => -74.0060, 'created_at' => $now, 'updated_at' => $now],
            ['country_id' => $countryIds['ZA'], 'name' => 'Cape Town', 'lat' => -33.9249, 'lng' => 18.4241, 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('cities_network_agent')->insert($cities);

        // ====================================
        // Ambil ID kota
        // ====================================
        $cityIds = DB::table('cities_network_agent')->pluck('id', 'name');

        // ====================================
        // AGENTS
        // ====================================
        $agents = [
            ['name' => 'Jakarta 1','code' => 'ID-JKT-001','country_id' => $countryIds['ID'],'city_id' => $cityIds['Jakarta'],'address' => 'Jl. Merdeka No.1, Jakarta','lat' => -6.2088,'lng' => 106.8456,'phone' => '+62 21 555 1111','email' => 'jakarta1@company.com','image' => 'DefaultAgent.jpg','status' => 'active','created_at' => $now,'updated_at' => $now],
            ['name' => 'Jakarta 2','code' => 'ID-JKT-002','country_id' => $countryIds['ID'],'city_id' => $cityIds['Jakarta'],'address' => 'Jl. Thamrin No.5, Jakarta','lat' => -6.2170,'lng' => 106.8450,'phone' => '+62 21 555 2222','email' => 'jakarta2@company.com','image' => 'DefaultAgent.jpg','status' => 'active','created_at' => $now,'updated_at' => $now],
            ['name' => 'Jakarta 3','code' => 'ID-JKT-003','country_id' => $countryIds['ID'],'city_id' => $cityIds['Jakarta'],'address' => 'Jl. Sudirman No.8, Jakarta','lat' => -6.2121,'lng' => 106.8459,'phone' => '+62 21 555 3333','email' => 'jakarta3@company.com','image' => 'DefaultAgent.jpg','status' => 'active','created_at' => $now,'updated_at' => $now],
            ['name' => 'Tokyo Port','code' => 'JP-TYO-001','country_id' => $countryIds['JP'],'city_id' => $cityIds['Tokyo'],'address' => 'Chuo-ku, Tokyo','lat' => 35.6895,'lng' => 139.6917,'phone' => '+81 3 5555 8888','email' => 'tokyo@company.com','image' => 'DefaultAgent.jpg','status' => 'active','created_at' => $now,'updated_at' => $now],
            ['name' => 'Paris Office','code' => 'FR-PAR-001','country_id' => $countryIds['FR'],'city_id' => $cityIds['Paris'],'address' => 'Rue de Rivoli, Paris','lat' => 48.8566,'lng' => 2.3522,'phone' => '+33 1 5555 9999','email' => 'paris@company.com','image' => 'DefaultAgent.jpg','status' => 'active','created_at' => $now,'updated_at' => $now],
            ['name' => 'New York Branch','code' => 'US-NY-001','country_id' => $countryIds['US'],'city_id' => $cityIds['New York'],'address' => '5th Avenue, New York','lat' => 40.7128,'lng' => -74.0060,'phone' => '+1 212 555 7777','email' => 'ny@company.com','image' => 'DefaultAgent.jpg','status' => 'active','created_at' => $now,'updated_at' => $now],
            ['name' => 'Cape Town Port','code' => 'ZA-CT-001','country_id' => $countryIds['ZA'],'city_id' => $cityIds['Cape Town'],'address' => 'Dock Road, Cape Town','lat' => -33.9249,'lng' => 18.4241,'phone' => '+27 21 555 4444','email' => 'capetown@company.com','image' => 'DefaultAgent.jpg','status' => 'active','created_at' => $now,'updated_at' => $now],
        ];

        DB::table('agents_network')->insert($agents);
    }
}
