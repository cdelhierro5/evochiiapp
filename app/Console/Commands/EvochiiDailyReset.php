<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EvochiiDailyReset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evochii:daily-reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'El Juicio de Medianoche: Evalúa hábitos, racha y aplica daño vital.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Iniciando el Juicio de Medianoche...');
        
        $users = \App\Models\User::with(['tamagochi', 'habits'])->get();
        
        foreach ($users as $user) {
            $t = $user->tamagochi;
            if (!$t) continue;

            $habits = $user->habits;
            $habitsCompletedCount = 0;

            foreach ($habits as $h) {
                if ($h->completed_today >= $h->target_count) {
                    $habitsCompletedCount++;
                } else {
                    // Hábito fallido: DAÑO VITAL
                    if (stripos($h->name, 'dormir') !== false) {
                        $t->energy = min(40, $t->energy);
                    }
                    if (stripos($h->name, 'meditar') !== false) {
                        $t->zen = max(0, $t->zen - 30);
                    }
                    if (stripos($h->name, 'agua') !== false) {
                        $t->energy = max(0, $t->energy - 20);
                    }
                    
                    $h->current_streak = 0;
                }
                
                $h->completed_today = 0;
                $h->save();
            }

            // Involución por inactividad total (3 días sin ningún hábito)
            if ($habitsCompletedCount === 0) {
                if ($t->updated_at < now()->subDays(3)) {
                    $t->level = max(1, $t->level - 1);
                    $t->experience = 0;
                    $t->current_thought = "Me siento tan débil... mi espíritu se encoge.";
                }
            }

            $t->last_reset_at = now();
            $t->updateStatus()->save();
        }

        $this->info("Juicio finalizado para {$users->count()} usuarios.");
        return 0;
    }
}
