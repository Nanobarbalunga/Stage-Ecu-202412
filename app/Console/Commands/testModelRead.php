<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\modelProva;

class testModelRead extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mik:app:test-model-read';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $records = modelProva::all();
        if($records){
            $this->info("Lista dei prossimi records");
            $this->info($records);
        }
        else{
            $this->info("Non ho trovato una mazza");
        }

    }
}
