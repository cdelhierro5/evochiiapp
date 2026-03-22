<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EvochiiMetabolism extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evochii:metabolism';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->info('Ejecutando metabolismo horario de Evochiis...');
        
        $tamagochis = \App\Models\Tamagochi::all();
        
        foreach ($tamagochis as $t) {
            // Decaimiento metabólico: -3% en stats principales
            $t->foco   = max(0, $t->foco - 3);
            $t->energy = max(0, $t->energy - 3);
            $t->zen    = max(0, $t->zen - 3);
            
            // Hambre aumenta sutilmente
            $t->hunger = min(100, $t->hunger + 2);
            
            $t->updateStatus()->save();
        }
        
        $this->info("Metabolismo actualizado para {$tamagochis->count()} Evochiis.");
        return Command::SUCCESS;
    }
}
