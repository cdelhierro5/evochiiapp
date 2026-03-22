<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HabitInitializeImpacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'habits:init-impacts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inicializa los impactos de stats y XP para hábitos existentes.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Actualizando matriz de impacto para hábitos existentes...');
        
        $habits = \App\Models\Habit::all();
        $updated = 0;

        $matrix = [
            'dormir'     => ['e' => 30, 'f' => 0,  'z' => 20, 'xp' => 15],
            'ejercicio'  => ['e' => -10, 'f' => 20, 'z' => 0,  'xp' => 20],
            'comida'     => ['e' => 10, 'f' => 0,  'z' => 5,  'xp' => 10],
            'móvil'      => ['e' => 0,  'f' => 15, 'z' => 10, 'xp' => 10],
            'leer'       => ['e' => -5, 'f' => 20, 'z' => 0,  'xp' => 15],
            'aprender'   => ['e' => -5, 'f' => 20, 'z' => 0,  'xp' => 15],
            'pausa'      => ['e' => 10, 'f' => 5,  'z' => 10, 'xp' => 10],
            'agua'       => ['e' => 15, 'f' => 0,  'z' => 10, 'xp' => 10],
            'meditar'    => ['e' => 0,  'f' => 10, 'z' => 25, 'xp' => 15],
            'planificar' => ['e' => 0,  'f' => 15, 'z' => 5,  'xp' => 10],
            'agradecer'  => ['e' => 0,  'f' => 0,  'z' => 20, 'xp' => 10],
            'orden'      => ['e' => 0,  'f' => 10, 'z' => 10, 'xp' => 10],
            'diario'     => ['e' => 0,  'f' => 5,  'z' => 15, 'xp' => 10],
        ];

        foreach ($habits as $h) {
            $found = false;
            foreach ($matrix as $key => $vals) {
                if (stripos($h->name, $key) !== false) {
                    $h->energy_impact = $vals['e'];
                    $h->focus_impact  = $vals['f'];
                    $h->zen_impact    = $vals['z'];
                    $h->xp_reward     = $vals['xp'];
                    $found = true;
                    break;
                }
            }

            // Si no coincide con ninguno, aplicar defaults equilibrados
            if (!$found) {
                $h->energy_impact = $h->energy_impact ?: 5;
                $h->focus_impact  = $h->focus_impact ?: 2;
                $h->zen_impact    = $h->zen_impact ?: 5;
                $h->xp_reward     = $h->xp_reward ?: 10;
            }

            $h->save();
            $updated++;
        }

        $this->info("¡Éxito! Se han actualizado {$updated} hábitos.");
        return 0;
    }
}
