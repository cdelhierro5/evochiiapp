<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tamagochi;
use App\Models\User;

class CommunityController extends Controller
{
    /**
     * Obtiene el ranking global de Evochiis.
     */
    public function rankings(Request $request)
    {
        // Ranking basado en racha acumulada (habit_streak) o nivel de energía
        $rankings = Tamagochi::with('user')
            ->whereNotNull('avatar')
            ->orderBy('energy', 'desc')
            ->limit(10)
            ->get()
            ->map(function($t) {
                return [
                    'id' => $t->id,
                    'name' => $t->name,
                    'avatar' => $t->avatar,
                    'energy' => $t->energy,
                    'user_name' => $t->user->name,
                    'thought' => $t->current_thought ?? "¡Hola mundo!"
                ];
            });

        return response()->json(['data' => $rankings]);
    }

    /**
     * Obtiene la lista de "amigos" o usuarios sugeridos.
     */
    public function friends(Request $request)
    {
        // Por ahora, devolvemos algunos otros Evochiis activos como sugerencias
        $others = Tamagochi::with('user')
            ->where('user_id', '!=', $request->user()->id)
            ->whereNotNull('avatar')
            ->inRandomOrder()
            ->limit(5)
            ->get()
            ->map(function($t) {
                return [
                    'id' => $t->id,
                    'name' => $t->name,
                    'avatar' => $t->avatar,
                    'user_name' => $t->user->name,
                    'energy' => $t->energy
                ];
            });

        return response()->json(['data' => $others]);
    }

    /**
     * Interacción social (alimentar/acariciar) que no afecta estadísticas reales.
     */
    public function socialInteract(Request $request)
    {
        $request->validate([
            'target_id' => 'required|exists:tamagochis,id',
            'type' => 'required|in:feed,pet,cheer'
        ]);

        // Aquí podríamos registrar la interacción en una tabla de logs sociales
        // Pero el requerimiento dice que NO afecta las condiciones del dueño.
        
        return response()->json([
            'message' => 'Interacción social enviada correctamente',
            'type' => $request->type
        ]);
    }
}
