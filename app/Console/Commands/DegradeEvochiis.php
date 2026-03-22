<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DegradeEvochiis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evochii:degrade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Degrada las estadísticas de los Evochiis inactivos por más de 24h';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Iniciando degradación de Evochiis inactivos...');
        
        $inactivos = \App\Models\Tamagochi::where('updated_at', '<', now()->subHours(24))->get();
        
        foreach ($inactivos as $t) {
            $t->foco = max(0, $t->foco - 15);
            $t->energy = max(0, $t->energy - 15);
            $t->zen = max(0, $t->zen - 15);
            $t->health = max(0, $t->health - 10);
            $t->happiness = max(0, $t->happiness - 10);
            $t->hunger = min(100, $t->hunger + 20);
            
            $t->updateStatus()->save();
        }
        
        $this->info("Degradados {$inactivos->count()} Evochiis exitosamente.");
        return Command::SUCCESS;
    }
}
