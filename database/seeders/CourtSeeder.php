<?php

namespace Database\Seeders;

use App\Models\Court;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    public function run(): void
    {
        Court::create([
            'name' => 'Lapangan Futsal 1',
            'type' => 'Futsal',
            'price_per_hour' => 100000,
            'description' => 'Lapangan futsal dengan rumput sintetis.',
            'image' => null,
        ]);

        Court::create([
            'name' => 'Lapangan Futsal 2',
            'type' => 'Futsal',
            'price_per_hour' => 120000,
            'description' => 'Lapangan futsal indoor dengan fasilitas lengkap.',
            'image' => null,
        ]);

        Court::create([
            'name' => 'Lapangan Badminton 1',
            'type' => 'Badminton',
            'price_per_hour' => 50000,
            'description' => 'Lapangan badminton dengan lantai vinyl.',
            'image' => null,
        ]);

        Court::create([
            'name' => 'Lapangan Basket 1',
            'type' => 'Basket',
            'price_per_hour' => 80000,
            'description' => 'Lapangan basket indoor.',
            'image' => null,
        ]);
    }
}