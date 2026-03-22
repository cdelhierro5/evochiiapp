<?php

namespace App\Http\Controllers;

use App\Models\Tamagochi;
use App\Services\LLMService;
use Illuminate\Http\Request;

class TamagochiController extends Controller
{
    protected $llm;

    public function __construct(LLMService $llm)
    {
        $this->llm = $llm;
    }

    /**
     * Sincronizar (Onboarding) el Evochii
     */
    public function sync(Request $request)
    {
        $validated = $request->validate([
            'contextoVital' => 'nullable|string|max:2000',
            'personalidadIA' => 'required|string|in:Sargento estricto,Abuela cariñosa,Colega sarcástico,Meme Lord,Filósofo Estoico,Entrenador Personal,Explorador Curioso,Ninja de Productividad,Guardián Zen',
            'avatar' => 'required|string',
            'habits' => 'nullable|array',
        ]);

        $user = $request->user();
        $tamagochi = $user->tamagochi;

        if (!$tamagochi) {
            $tamagochi = $user->tamagochi()->create([
                'name' => 'Evochii de ' . $user->name,
                'avatar' => $validated['avatar'],
                'status' => 'normal',
                'foco' => 50,
                'energy' => 100,
                'zen' => 50,
            ]);
        }

        $tamagochi->update([
            'context_vital' => $validated['contextoVital'] ?? 'Protocolo Evochii v2.5 activo.',
            'ai_personality' => $validated['personalidadIA'],
            'avatar' => $validated['avatar'],
            'current_thought' => 'Sincronización biométrica completada. Iniciando fase de evolución...',
        ]);

        // Crear hábitos predefinidos si se seleccionaron
        if (!empty($validated['habits'])) {
            $predefinedHabits = [
                'sleep' => ['name' => '💤 Rutina pre-dormir', 'category' => 'salud', 'reward_energy' => 10],
                'exercise' => ['name' => '🏋️ Ejercicio diario', 'category' => 'ejercicio', 'reward_energy' => 15],
                'food' => ['name' => '🍎 Alimentación sana', 'category' => 'salud', 'reward_energy' => 5],
                'mobile' => ['name' => '📵 Limitar móvil', 'category' => 'productividad', 'reward_energy' => 10],
                'read' => ['name' => '📚 Leer / Aprender', 'category' => 'educacion', 'reward_energy' => 5],
                'stretch' => ['name' => '🧘 Pausa activa', 'category' => 'salud', 'reward_energy' => 5],
                'water' => ['name' => '💧 Beber Agua', 'category' => 'salud', 'reward_energy' => 5],
                'meditate' => ['name' => '🧠 Meditación', 'category' => 'zen', 'reward_energy' => 10],
                'plan' => ['name' => '📅 Planificar Día', 'category' => 'productividad', 'reward_energy' => 10],
                'thanks' => ['name' => '✨ Agradecimiento', 'category' => 'zen', 'reward_energy' => 5],
                'order' => ['name' => '🏠 Orden y Limpieza', 'category' => 'productividad', 'reward_energy' => 5],
            ];

            foreach ($validated['habits'] as $habitKey) {
                if (isset($predefinedHabits[$habitKey])) {
                    $user->habits()->updateOrCreate(
                        ['name' => $predefinedHabits[$habitKey]['name']],
                        [
                            'category' => $predefinedHabits[$habitKey]['category'],
                            'frequency' => 'diario',
                            'target_count' => 1,
                            'reward_energy' => $predefinedHabits[$habitKey]['reward_energy'],
                            'is_active' => true,
                        ]
                    );
                }
            }
        }

        return response()->json([
            'message' => '✅ Evochii sincronizado con éxito',
            'data' => $tamagochi,
        ], 200);
    }

    /**
     * Interactuar con el Gemelo Digital
     */
    public function interact(Request $request)
    {
        $validated = $request->validate([
            'action' => 'required|string|in:work,rest,distraction',
        ]);

        $tamagochi = $request->user()->tamagochi;

        if (!$tamagochi) {
            return response()->json(['message' => 'Sincroniza tu gemelo primero'], 404);
        }

        $action = $validated['action'];
        $actionName = '';

        switch ($action) {
            case 'work':
                $tamagochi->foco = min(100, $tamagochi->foco + 15);
                $tamagochi->energy = max(0, $tamagochi->energy - 15);
                $actionName = 'Sesión de Trabajo (Foco)';
                break;
            case 'rest':
                $tamagochi->energy = min(100, $tamagochi->energy + 15);
                $tamagochi->zen = min(100, $tamagochi->zen + 15);
                $actionName = 'Descanso / Autocuidado';
                break;
            case 'distraction':
                $tamagochi->foco = max(0, $tamagochi->foco - 15);
                $tamagochi->zen = max(0, $tamagochi->zen - 15);
                $actionName = 'Distracción / Redes Sociales';
                break;
        }

        // Generar respuesta IA
        $thought = $this->llm->generateResponse(
            $tamagochi->ai_personality,
            $tamagochi->context_vital,
            $tamagochi->foco,
            $tamagochi->energy,
            $tamagochi->zen,
            $actionName
        );

        $tamagochi->current_thought = $thought;
        $tamagochi->save();

        return response()->json([
            'message' => 'Interacción procesada',
            'data' => $tamagochi,
            'thought' => $thought,
        ], 200);
    }

    /**
     * Obtener estado del tamagochi del usuario actual
     */
    public function show(Request $request)
    {
        $tamagochi = $request->user()->tamagochi;

        if (!$tamagochi) {
            return response()->json([
                'message' => 'Tamagochi no encontrado',
            ], 404);
        }

        return response()->json([
            'data' => $tamagochi,
            'avatars' => Tamagochi::$avatars,
        ], 200);
    }

    /**
     * Alimentar al tamagochi
     */
    public function feed(Request $request)
    {
        $tamagochi = $request->user()->tamagochi;

        if (!$tamagochi) {
            return response()->json([
                'message' => 'Tamagochi no encontrado',
            ], 404);
        }

        $tamagochi->feed();

        return response()->json([
            'message' => '✅ ¡Tu tamagochi ha sido alimentado!',
            'data' => $tamagochi,
        ], 200);
    }

    /**
     * Jugar con el tamagochi
     */
    public function play(Request $request)
    {
        $tamagochi = $request->user()->tamagochi;

        if (!$tamagochi) {
            return response()->json([
                'message' => 'Tamagochi no encontrado',
            ], 404);
        }

        $tamagochi->play();

        return response()->json([
            'message' => '✅ ¡Ha sido una sesión divertida!',
            'data' => $tamagochi,
        ], 200);
    }

    /**
     * Descansar con el tamagochi
     */
    public function sleep(Request $request)
    {
        $tamagochi = $request->user()->tamagochi;

        if (!$tamagochi) {
            return response()->json([
                'message' => 'Tamagochi no encontrado',
            ], 404);
        }

        $tamagochi->sleep();

        return response()->json([
            'message' => '✅ ¡Tu tamagochi está descansando!',
            'data' => $tamagochi,
        ], 200);
    }

    /**
     * Actualizar nombre del tamagochi
     */
    public function updateName(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $tamagochi = $request->user()->tamagochi;

        if (!$tamagochi) {
            return response()->json([
                'message' => 'Tamagochi no encontrado',
            ], 404);
        }

        $tamagochi->update(['name' => $validated['name']]);

        return response()->json([
            'message' => '✅ Nombre actualizado',
            'data' => $tamagochi,
        ], 200);
    }

    /**
     * Actualizar avatar del tamagochi
     */
    public function updateAvatar(Request $request)
    {
        $validated = $request->validate([
            'avatar' => 'required|string|in:' . implode(',', array_keys(Tamagochi::$avatars)),
        ]);

        $tamagochi = $request->user()->tamagochi;

        if (!$tamagochi) {
            return response()->json([
                'message' => 'Tamagochi no encontrado',
            ], 404);
        }

        $tamagochi->update(['avatar' => $validated['avatar']]);

        return response()->json([
            'message' => '✅ ¡Avatar actualizado!',
            'data' => $tamagochi,
            'emoji' => $tamagochi->getCurrentEmoji(),
        ], 200);
    }
}
