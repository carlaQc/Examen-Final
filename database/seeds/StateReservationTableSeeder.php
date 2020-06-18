<?php

use Illuminate\Database\Seeder;
use App\ReservationState;

class StateReservationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReservationState::create([
            'state' => 'Pendiente',
        ]);
        ReservationState::create([
            'state' => 'Reservado',
        ]);        
        ReservationState::create([
            'state' => 'Expirado',
        ]);
    }

}