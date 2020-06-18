<?php

use Illuminate\Database\Seeder;
use App\ReservationPayment;

class ReservationPaymentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReservationPayment::create([
        	'description_payment' => 'Pago Pendiente'
        ]);
        ReservationPayment::create([
        	'description_payment' => 'Pago Anticipado'
        ]);
        ReservationPayment::create([
        	'description_payment' => 'Pago Total'
        ]);
    }
}
