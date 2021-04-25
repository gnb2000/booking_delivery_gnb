<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Books;
use Bookings;

class BookingUpdater extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:booking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Move down moto_available number due to day change';

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
     * @return int
     */
    public function handle()
    {
        
        //Updating values of the Books table

        $bookings = Books::select('id','cols','rows','start_time','moto_available')
                ->orderBy('cols')
                ->get();

        $pos = 0;
        for($i=0;$i<count($bookings);$i++) { 
            if ($pos == 6){
                $bookings[$i]->moto_available = 8;
                $bookings[$i]->save();
            } else {
                //Correr el valor de las motos disponibles una posicion para atras y la ultima ponerle un 8 
                $bookings[$i]->moto_available =  $bookings[$i+1]->moto_available;
                $bookings[$i]->save();
            }
            $pos+=1;
            if ($pos > 6){
                $pos = 0;
            }
        } 

    }
}
