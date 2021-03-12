<?php

namespace Database\Seeders;

use App\Models\Empresa;
use App\Models\Empleado;
use Illuminate\Database\Seeder;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::factory()
            ->count(10)
            ->has(Empleado::factory()->count(5))
            ->create();
    }
}
