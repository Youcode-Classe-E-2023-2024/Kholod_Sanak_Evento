<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoroccanCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            'Agadir',
            'Al Hoceima',
            'Beni Mellal',
            'Casablanca',
            'Dakhla',
            'El Jadida',
            'Errachidia',
            'Essaouira',
            'Fes',
            'Kénitra',
            'Khémisset',
            'Khouribga',
            'Laayoune',
            'Larache',
            'Marrakech',
            'Meknes',
            'Nador',
            'Ouarzazate',
            'Oujda',
            'Rabat',
            'Safi',
            'Settat',
            'Sidi Kacem',
            'Tangier',
            'Taza',
            'Tétouan',
        ];

        foreach ($cities as $city) {
            DB::table('lieu')->insert([
                'ville' => $city,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
