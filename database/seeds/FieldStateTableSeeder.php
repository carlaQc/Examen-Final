<?php

use Illuminate\Database\Seeder;

use App\FieldState;

class FieldStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FieldState::create([
        	'description' => 'Habilitado'
        ]);
        FieldState::create([
        	'description' => 'Deshabilitado'
        ]);
        FieldState::create([
        	'description' => 'Limpieza'
        ]);
    }
}