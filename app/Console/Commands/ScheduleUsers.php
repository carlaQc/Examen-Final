<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Reservation;
use Carbon\Carbon;

class ScheduleUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'center:scheduleUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to update the status of sports center reservations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Para cambiar el estado de la reserva automaticamente
        Reservation::whereTime('date_expire','<=',Carbon::now()->format('H:i:s'))
                    ->where('reservation_state_id',1)
                    ->update(['reservation_state_id'=>3]);
    }
}
