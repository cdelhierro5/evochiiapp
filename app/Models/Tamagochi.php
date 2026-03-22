<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamagochi extends Model
{
    use HasFactory;

    protected $table = 'tamagochis';

    protected $appends = ['xp'];

    public function getXpAttribute() { return $this->experience; }
    public function setXpAttribute($value) { $this->experience = $value; }

    protected $fillable = [
        'user_id',
        'name',
        'avatar',
        'status',
        'energy',
        'hunger',
        'happiness',
        'health',
        'last_fed',
        'last_played',
        'times_played',
        'level',
        'experience',
        'context_vital',
        'ai_personality',
        'foco',
        'zen',
        'current_thought',
        'evolution_points',
        'last_reset_at',
    ];

    protected $casts = [
        'last_fed' => 'datetime',
        'last_played' => 'datetime',
        'foco' => 'integer',
        'zen' => 'integer',
        'energy' => 'integer',
        'last_reset_at' => 'datetime',
    ];

    /**
     * Avatares disponibles con sus emojis por estado
     */
    public static $avatars = [
        'fish'    => ['name' => 'Pez',       'happy' => '🐠', 'normal' => '🐟', 'sad' => '🐡', 'tired' => '😴', 'sick' => '🤒', 'sleeping' => '💤', 'dead' => '💀'],
        'cat'     => ['name' => 'Gato',      'happy' => '😺', 'normal' => '🐱', 'sad' => '😿', 'tired' => '😾', 'sick' => '🤒', 'sleeping' => '😸', 'dead' => '💀'],
        'dog'     => ['name' => 'Perro',     'happy' => '🐶', 'normal' => '🐕', 'sad' => '🥺', 'tired' => '😴', 'sick' => '🤒', 'sleeping' => '💤', 'dead' => '💀'],
        'rabbit'  => ['name' => 'Conejo',    'happy' => '🐰', 'normal' => '🐇', 'sad' => '😢', 'tired' => '😴', 'sick' => '🤒', 'sleeping' => '💤', 'dead' => '💀'],
        'panda'   => ['name' => 'Panda',     'happy' => '🐼', 'normal' => '🐻', 'sad' => '😢', 'tired' => '😴', 'sick' => '🤒', 'sleeping' => '💤', 'dead' => '💀'],
        'dragon'  => ['name' => 'Dragón',    'happy' => '🐲', 'normal' => '🐉', 'sad' => '😢', 'tired' => '😴', 'sick' => '🤒', 'sleeping' => '💤', 'dead' => '💀'],
        'unicorn' => ['name' => 'Unicornio', 'happy' => '🦄', 'normal' => '🦄', 'sad' => '😢', 'tired' => '😴', 'sick' => '🤒', 'sleeping' => '💤', 'dead' => '💀'],
        'alien'   => ['name' => 'Alien',     'happy' => '👾', 'normal' => '👽', 'sad' => '😢', 'tired' => '😴', 'sick' => '🤒', 'sleeping' => '💤', 'dead' => '💀'],
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el emoji actual según avatar y estado
     */
    public function getCurrentEmoji()
    {
        $avatar = self::$avatars[$this->avatar] ?? self::$avatars['fish'];
        $status = $this->status ?? 'normal';

        return $avatar[$status] ?? $avatar['normal'];
    }

    /**
     * Obtener el estado general del tamagochi
     */
    public function updateStatus()
    {
        if ($this->health < 30) {
            $this->status = 'sick';
        } elseif ($this->energy < 20) {
            $this->status = 'sleeping';
        } elseif ($this->happiness < 40) {
            $this->status = 'sad';
        } elseif ($this->energy < 50) {
            $this->status = 'tired';
        } elseif ($this->happiness > 80) {
            $this->status = 'happy';
        } else {
            $this->status = 'normal';
        }

        return $this;
    }

    /**
     * Aplicar recompensas de un hábito completado
     */
    public function applyHabitReward($habit)
    {
        // 1. Aplicar Impactos de Stats (Matriz)
        $this->energy = max(0, min(100, $this->energy + $habit->energy_impact));
        $this->foco = max(0, min(100, $this->foco + $habit->focus_impact));
        $this->zen = max(0, min(100, $this->zen + $habit->zen_impact));
        
        // Recompensas base heredadas (si existen)
        if ($habit->reward_energy > 0) $this->energy = min(100, $this->energy + $habit->reward_energy);
        if ($habit->reward_happiness > 0) $this->happiness = min(100, $this->happiness + $habit->reward_happiness);
        if ($habit->reward_health > 0) $this->health = min(100, $this->health + $habit->reward_health);

        // 2. Sistema de XP y Evolución
        $xpGained = $habit->xp_reward ?? 10;
        
        // Regla especial: "Ejercicio Físico" da el doble de XP
        if (stripos($habit->name, 'ejercicio') !== false || stripos($habit->name, 'deporte') !== false) {
            $xpGained *= 2;
        }

        $this->experience += $xpGained;
        $hasEvolved = false;

        // Umbral de evolución: 100 * nivel actual
        $threshold = 100 * $this->level;
        if ($this->experience >= $threshold) {
            $this->level++;
            $this->experience -= $threshold; // Mantener sobrante
            $hasEvolved = true;
            $this->evolution_points += 5; // Recompensa por nivel
        }

        $this->updateStatus()->save();

        return [
            'tamagochi' => $this,
            'has_evolved' => $hasEvolved,
            'xp_gained' => $xpGained
        ];
    }

    /**
     * Alimentar al tamagochi
     */
    public function feed()
    {
        $this->hunger = max(0, $this->hunger - 30);
        $this->energy = max(0, $this->energy - 5);
        $this->last_fed = now();

        if ($this->hunger < 50) {
            $this->happiness = min(100, $this->happiness + 10);
        }

        $this->updateStatus()->save();

        return $this;
    }

    /**
     * Jugar con el tamagochi
     */
    public function play()
    {
        $this->energy = max(0, $this->energy - 20);
        $this->hunger = min(100, $this->hunger + 15);
        $this->happiness = min(100, $this->happiness + 25);
        $this->last_played = now();
        $this->times_played++;

        $this->experience += 10;
        if ($this->experience >= 100 * $this->level) {
            $this->level++;
            $this->experience = 0;
        }

        $this->updateStatus()->save();

        return $this;
    }

    /**
     * Descansar
     */
    public function sleep()
    {
        $this->energy = min(100, $this->energy + 50);
        $this->health = min(100, $this->health + 10);
        $this->status = 'sleeping';

        $this->save();

        return $this;
    }
}
