<?php

namespace Database\Seeders;

use App\Models\Privilege;
use Illuminate\Database\Seeder;

class PrivilegesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Privilege::create(['name' => 'Anciano', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Diácono', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Diaconisa', 'preferred_sex' => 'F', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comisión de Arreglos Florales', 'preferred_sex' => 'F','min_age' => 12]);
        Privilege::create(['name' => 'Comisión de Multimedia', 'preferred_status' => 1, 'min_age' => 12]);
        Privilege::create(['name' => 'Comisión de Redes Sociales (La Red)', 'preferred_status' => 1, 'min_age' => 12]);
        Privilege::create(['name' => 'Comisión de Sonido', 'preferred_status' => 1, 'min_age' => 12]);
        Privilege::create(['name' => 'Comisión de Transporte', 'preferred_sex' => 'M', 'min_age' => 18]);
        Privilege::create(['name' => 'Comisión de Visita', 'preferred_sex' => 'M', 'min_age' => 18]);
        Privilege::create(['name' => 'Comité de Beneficencia (hombres)', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comité de Beneficencia (mujeres)', 'preferred_sex' => 'F', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comité Campo "Buena Vista"', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comité Campo Evangelístico "El Chuluc"', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comité Campo Evangelístico Pahuit', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comité Campo Evangelístico Zona 3', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comité Campo Evangelístico Zona 4 "A"', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comité Campo Evangelístico Zona 4 "B"', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comité Campo "La Esperanza"', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comité de Centro Estudiantil', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comité de Colegio Bethel', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comité de Educación Cristiana', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comité de Evangelismo', 'preferred_sex' => 'M', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Comité de Limpieza Externa (hombres)', 'preferred_sex' => 'M', 'min_age' => 16]);
        Privilege::create(['name' => 'Comité de Limpieza (mujeres)', 'preferred_sex' => 'F', 'min_age' => 16]);
        Privilege::create(['name' => 'Maestro(a) de Clases Navideñas', 'min_age' => 18]);
        Privilege::create(['name' => 'Maestro(a) de Escuela Dominical', 'min_age' => 18]);
        Privilege::create(['name' => 'Maestro(a) de Escuela de Vacaciones', 'min_age' => 18]);
        Privilege::create(['name' => 'Directiva Intermedios', 'preferred_status' => 1, 'min_age' => 12, 'max_age' => 14]);
        Privilege::create(['name' => 'Directiva Pre-Jovenes', 'preferred_status' => 1, 'min_age' => 15, 'max_age' => 18]);
        Privilege::create(['name' => 'Directiva Aula D7', 'preferred_status' => 1, 'min_age' => 16, 'max_age' => 30]);
        Privilege::create(['name' => 'Directiva Congreso Juvenil', 'preferred_status' => 1, 'min_age' => 16]);
        Privilege::create(['name' => 'Directiva Unión Juvenil (UJ)', 'preferred_status' => 1, 'min_age' => 16]);
        Privilege::create(['name' => 'Directiva Sociedad Femenil "Alfa & Omega"', 'preferred_sex' => 'F', 'preferred_status' => 2]);
        Privilege::create(['name' => 'Director(a) de Servicios', 'min_age' => 16]);
        Privilege::create(['name' => 'Musico/director(a) de Alabanza', 'min_age' => 12]);
        Privilege::create(['name' => 'Predicador(a)', 'min_age' => 18]);
        Privilege::create(['name' => 'Proyecto de Siembra', 'preferred_sex' => 'M', 'min_age' => 18]);
        Privilege::create(['name' => 'Proyecto Sonrisitas', 'min_age' => 14]);
        Privilege::create(['name' => 'Sala Cuna', 'preferred_sex' => 'F', 'min_age' => 18]);
        Privilege::create(['name' => 'Consejero(a)', 'preferred_status' => 2]);
    }
}
