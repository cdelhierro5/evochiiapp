<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'category',
        'frequency',
        'target_count',
        'current_streak',
        'best_streak',
        'times_completed',
        'completed_today',
        'last_completed_at',
        'is_active',
        'reward_energy',
        'reward_happiness',
        'reward_health',
        'energy_impact',
        'focus_impact',
        'zen_impact',
        'xp_reward',
    ];

    protected $casts = [
        'last_completed_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Completar el hábito y aplicar recompensas al tamagochi
     */
    public function complete()
    {
        $now = Carbon::now();

        // Verificar si ya se completó hoy el target
        if ($this->isCompletedForPeriod()) {
            return ['success' => false, 'message' => 'Ya completaste este hábito para este periodo'];
        }

        $this->completed_today++;
        $this->times_completed++;
        $this->last_completed_at = $now;

        // Si alcanzó el target para este periodo, incrementar racha
        if ($this->completed_today >= $this->target_count) {
            $this->current_streak++;
            if ($this->current_streak > $this->best_streak) {
                $this->best_streak = $this->current_streak;
            }
        }

        $this->save();

        // Aplicar recompensas al tamagochi
        $tamagochi = $this->user->tamagochi;
        $rewardResult = null;
        if ($tamagochi) {
            $rewardResult = $tamagochi->applyHabitReward($this);
        }

        return [
            'success' => true,
            'message' => '¡Hábito completado!',
            'streak' => $this->current_streak,
            'has_evolved' => $rewardResult['has_evolved'] ?? false,
            'xp_gained' => $rewardResult['xp_gained'] ?? 0,
            'tamagochi' => $rewardResult['tamagochi'] ?? $tamagochi,
            'rewards' => [
                'energy' => $this->energy_impact + ($this->reward_energy ?? 0),
                'foco' => $this->focus_impact,
                'zen' => $this->zen_impact,
            ]
        ];
    }

    /**
     * Verificar si el hábito ya se completó para el periodo actual
     */
    public function isCompletedForPeriod()
    {
        return $this->completed_today >= $this->target_count;
    }

    /**
     * Resetear el contador diario si ya pasó el periodo
     */
    public function resetIfExpired()
    {
        if (!$this->last_completed_at) return;

        $now = Carbon::now();
        $shouldReset = false;

        switch ($this->frequency) {
            case 'diario':
                $shouldReset = !$this->last_completed_at->isToday();
                break;
            case 'semanal':
                $shouldReset = !$this->last_completed_at->isSameWeek($now);
                break;
            case 'mensual':
                $shouldReset = !$this->last_completed_at->isSameMonth($now);
                break;
        }

        if ($shouldReset) {
            // Si no completó en el periodo anterior, resetear racha
            $periodsPassed = $this->getPeriodsPassed();
            if ($periodsPassed > 1) {
                $this->current_streak = 0;
            }
            $this->completed_today = 0;
            $this->save();
        }
    }

    /**
     * Calcular cuántos periodos han pasado desde la última completación
     */
    private function getPeriodsPassed()
    {
        if (!$this->last_completed_at) return 0;

        $now = Carbon::now();

        switch ($this->frequency) {
            case 'diario':
                return $this->last_completed_at->diffInDays($now);
            case 'semanal':
                return $this->last_completed_at->diffInWeeks($now);
            case 'mensual':
                return $this->last_completed_at->diffInMonths($now);
        }

        return 0;
    }

    /**
     * Icono de la categoría
     */
    public function getCategoryIconAttribute()
    {
        $icons = [
            'salud' => '💊',
            'productividad' => '📈',
            'ejercicio' => '🏃',
            'social' => '👥',
            'educacion' => '📚',
            'otro' => '📌',
        ];

        return $icons[$this->category] ?? '📌';
    }
}
