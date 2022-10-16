<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Seeder;

class VillagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Village::create(['name' => 'Patzicía']);
        Village::create(['name' => 'Aldea Pahuit']);
        Village::create(['name' => 'Aldea "El Camán"']);
        Village::create(['name' => 'Aldea "El Sitán"']);
        Village::create(['name' => 'Caserío "La Esperanza"']);
        Village::create(['name' => 'Caserío "El Chuluc"']);
    }
}
