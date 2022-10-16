<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Seeder;

class CampusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Campus::create([
            'village_id' => 1,
            'name' => 'Iglesia Bethel Patzicía',
            'address' => '0 Av. 1-13 zona 1',
            'phone_number' => '78305072',
            'latitude' => 14.63245154478294,
            'longitude' => -90.92645998896595
        ]);

        Campus::create([
            'village_id' => 2,
            'name' => 'Campo Evangelístico Pahuit',
            'address' => 'Cerro Alto, Pahuit',
        ]);

        Campus::create([
            'village_id' => 5,
            'name' => 'Campo Evangelístico "La Esperanza"',
        ]);

        Campus::create([
            'village_id' => 6,
            'name' => 'Campo Evangelístico "El Chuluc"',
        ]);
    }
}
