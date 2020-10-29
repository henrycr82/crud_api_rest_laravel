<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DirectorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('directorios')->insert([
            [
                'nombre' => 'Daniel Castro',
                'direccion' => 'San Antonio',
                'telefono' => 123456,
                'foto' => null
            ],
            [
                'nombre' => 'Gabriela Yrazabal',
                'direccion' => 'Carrizal',
                'telefono' => 654789,
                'foto' => null
            ],
            [
                'nombre' => 'Henry Castro',
                'direccion' => 'Los Teques',
                'telefono' => 789456,
                'foto' => null
            ],
        ]);
    }
}
