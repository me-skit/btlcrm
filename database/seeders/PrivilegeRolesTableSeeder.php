<?php

namespace Database\Seeders;

use App\Models\PrivilegeRole;
use Illuminate\Database\Seeder;

class PrivilegeRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PrivilegeRole::create(['name' => 'Presidente(a)']);
        PrivilegeRole::create(['name' => 'Vice-Presidente(a)']);
        PrivilegeRole::create(['name' => 'Coordinador(a)']);
        PrivilegeRole::create(['name' => 'Sub-Coordinador(a)']);
        PrivilegeRole::create(['name' => 'Secretario(a)']);
        PrivilegeRole::create(['name' => 'Secretario(a) General']);
        PrivilegeRole::create(['name' => 'Secretario(a) Corresponsal']);
        PrivilegeRole::create(['name' => 'Secretario(a) de Actas']);
        PrivilegeRole::create(['name' => 'Sub-Secretario(a)']);
        PrivilegeRole::create(['name' => 'Tesorero(a)']);
        PrivilegeRole::create(['name' => 'Tesorero(a) General']);
        PrivilegeRole::create(['name' => 'Tesorero(a) de Proyectos']);
        PrivilegeRole::create(['name' => 'Sub-Tesorero(a)']);
        PrivilegeRole::create(['name' => 'Vocal I']);
        PrivilegeRole::create(['name' => 'Vocal II']);
        PrivilegeRole::create(['name' => 'Vocal III']);
        PrivilegeRole::create(['name' => 'Vocal IV']);
        PrivilegeRole::create(['name' => 'Vocal V ']);
        PrivilegeRole::create(['name' => 'Vocal VI']);
        PrivilegeRole::create(['name' => 'Vocal VII']);
        PrivilegeRole::create(['name' => 'Vocal VIII']);
        PrivilegeRole::create(['name' => 'Vocal IX']);
        PrivilegeRole::create(['name' => 'Vocal X']);
        PrivilegeRole::create(['name' => 'Auditor I']);
        PrivilegeRole::create(['name' => 'Auditor II']);
        PrivilegeRole::create(['name' => 'Auditor III']);
        PrivilegeRole::create(['name' => 'Colaborador(a)']);
        PrivilegeRole::create(['name' => 'Consejero(a)']);
        PrivilegeRole::create(['name' => 'Voluntario(a)']);
    }
}
