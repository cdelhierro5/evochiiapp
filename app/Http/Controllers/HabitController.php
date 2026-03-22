<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\Http\Request;

class HabitController extends Controller
{
    /**
     * Listar hábitos del usuario
     */
    public function index(Request $request)
    {
        $habits = $request->user()->habits()->orderBy('created_at', 'desc')->get();

        // Resetear contadores expirados
        foreach ($habits as $habit) {
            $habit->resetIfExpired();
        }

        return response()->json([
            'data' => $habits,
        ], 200);
    }

    /**
     * Crear nuevo hábito
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'category' => 'required|in:salud,productividad,ejercicio,social,educacion,otro',
            'frequency' => 'required|in:diario,semanal,mensual',
            'target_count' => 'nullable|integer|min:1|max:20',
            'reward_energy' => 'nullable|integer|min:-100|max:100',
            'reward_happiness' => 'nullable|integer|min:0|max:20',
            'reward_health' => 'nullable|integer|min:0|max:20',
            'energy_impact' => 'nullable|integer|min:-100|max:100',
            'focus_impact' => 'nullable|integer|min:-100|max:100',
            'zen_impact' => 'nullable|integer|min:-100|max:100',
            'xp_reward' => 'nullable|integer|min:0|max:1000',
        ]);

        $habit = $request->user()->habits()->create(array_merge($validated, [
            'target_count' => $validated['target_count'] ?? 1,
            'energy_impact' => $validated['energy_impact'] ?? ($validated['reward_energy'] ?? 5),
            'focus_impact' => $validated['focus_impact'] ?? 0,
            'zen_impact' => $validated['zen_impact'] ?? ($validated['reward_happiness'] ?? 5),
            'xp_reward' => $validated['xp_reward'] ?? 10,
        ]));

        return response()->json([
            'message' => '✅ ¡Hábito creado exitosamente!',
            'data' => $habit,
        ], 201);
    }

    /**
     * Actualizar hábito
     */
    public function update(Request $request, $id)
    {
        $habit = $request->user()->habits()->findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:100',
            'description' => 'nullable|string|max:255',
            'category' => 'sometimes|in:salud,productividad,ejercicio,social,educacion,otro',
            'frequency' => 'sometimes|in:diario,semanal,mensual',
            'target_count' => 'sometimes|integer|min:1|max:20',
            'is_active' => 'sometimes|boolean',
            'reward_energy' => 'sometimes|integer|min:-100|max:100',
            'reward_happiness' => 'sometimes|integer|min:0|max:20',
            'reward_health' => 'sometimes|integer|min:0|max:20',
            'energy_impact' => 'sometimes|integer|min:-100|max:100',
            'focus_impact' => 'sometimes|integer|min:-100|max:100',
            'zen_impact' => 'sometimes|integer|min:-100|max:100',
            'xp_reward' => 'sometimes|integer|min:0|max:1000',
        ]);

        $habit->update($validated);

        return response()->json([
            'message' => '✅ Hábito actualizado',
            'data' => $habit,
        ], 200);
    }

    /**
     * Eliminar hábito
     */
    public function destroy(Request $request, $id)
    {
        $habit = $request->user()->habits()->findOrFail($id);
        $habit->delete();

        return response()->json([
            'message' => '✅ Hábito eliminado',
        ], 200);
    }

    /**
     * Completar hábito
     */
    public function complete(Request $request, $id)
    {
        $habit = $request->user()->habits()->findOrFail($id);

        // Resetear si expiró el periodo
        $habit->resetIfExpired();

        $result = $habit->complete();

        if (!$result['success']) {
            return response()->json([
                'message' => $result['message'],
            ], 400);
        }

        return response()->json([
            'message' => '🎉 ' . $result['message'],
            'data' => $habit->fresh(),
            'streak' => $result['streak'],
            'rewards' => $result['rewards'],
            'xp_gained' => $result['xp_gained'] ?? 0,
            'has_evolved' => $result['has_evolved'] ?? false,
            'tamagochi' => $result['tamagochi'] ?? $request->user()->tamagochi,
        ], 200);
    }

    /**
     * Estadísticas de hábitos
     */
    public function stats(Request $request)
    {
        $habits = $request->user()->habits;

        $totalCompleted = $habits->sum('times_completed');
        $activeHabits = $habits->where('is_active', true)->count();
        $bestStreak = $habits->max('best_streak');
        $currentStreaks = $habits->where('is_active', true)->sum('current_streak');

        $categoryCounts = $habits->groupBy('category')->map->count();

        return response()->json([
            'data' => [
                'total_habits' => $habits->count(),
                'active_habits' => $activeHabits,
                'total_completed' => $totalCompleted,
                'best_streak' => $bestStreak ?? 0,
                'total_current_streaks' => $currentStreaks,
                'by_category' => $categoryCounts,
            ],
        ], 200);
    }
}
