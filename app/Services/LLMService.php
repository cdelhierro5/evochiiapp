<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LLMService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.llm.key') ?? env('OPENAI_API_KEY');
        $this->baseUrl = config('services.llm.url') ?? 'https://api.openai.com/v1/chat/completions';
    }

    /**
     * Generar respuesta del Gemelo Digital basada en el estado actual.
     */
    public function generateResponse($personality, $context, $foco, $energy, $zen, $action = 'interacción')
    {
        // Fallback si no hay API key para evitar errores en el demo
        if (!$this->apiKey) {
            return $this->getMockResponse($personality, $foco, $energy, $zen);
        }

        try {
            // Extraer bio-datos si el contexto es JSON
            $bioData = json_decode($context, true);
            if (is_array($bioData)) {
                $bioStr = "Edad: {$bioData['edad']}, Trabajo: {$bioData['trabajo']}, Objetivo: {$bioData['objetivo']}.";
            } else {
                $bioStr = $context;
            }

            // Contexto Temporal
            $hour = now()->hour;
            $month = now()->month;
            $seasons = [12=>'invierno', 1=>'invierno', 2=>'invierno', 3=>'primavera', 4=>'primavera', 5=>'primavera', 6=>'verano', 7=>'verano', 8=>'verano', 9=>'otoño', 10=>'otoño', 11=>'otoño'];
            $season = $seasons[$month];

            $prompt = "Eres un Evochii (un gemelo digital avanzado) con personalidad '{$personality}'.
            PERFIL DEL HUMANO: [{$bioStr}].
            ENTORNO ACTUAL: Es {$season}, son las {$hour}:00h.
            ESTADOS VITALES (0-100): Foco: {$foco}, Energía: {$energy}, Zen: {$zen}.
            ACCIÓN RECIENTE: El humano ha realizado: {$action}.
            
            MISIÓN: Genera una única frase corta (máximo 15 palabras) reaccionando a la acción. 
            Debes sonar como tu personalidad, pero integra (si es relevante) el momento del día, la estación o el perfil del humano (trabajo/edad/meta).";

            $response = Http::withToken($this->apiKey)
                ->post($this->baseUrl, [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => $prompt],
                    ],
                    'max_tokens' => 60,
                    'temperature' => 0.8,
                ]);

            if ($response->successful()) {
                return $response->json('choices.0.message.content');
            }

            Log::error('LLM API Error: ' . $response->body());
            return $this->getMockResponse($personality, $foco, $energy, $zen);

        } catch (\Exception $e) {
            Log::error('LLM Service Exception: ' . $e->getMessage());
            return $this->getMockResponse($personality, $foco, $energy, $zen);
        }
    }

    /**
     * Respuesta de reserva si falla la IA o no hay API Key.
     */
    protected function getMockResponse($personality, $foco, $energy, $zen)
    {
        $responses = [
            'Sargento estricto' => [
                '¡Soldado, tu energía está por los suelos! ¡Descansa o te daré 50 flexiones!',
                'Foco al máximo. Sigue así y conquistarás el mundo.',
                '¿Zen bajo? ¡La meditación es obligatoria, muévete!',
            ],
            'Abuela cariñosa' => [
                'Cariño, te veo cansadito. ¿Por qué no tomas una siesta?',
                'Qué orgullosa estoy de lo mucho que estás trabajando hoy.',
                'Tómate un té, vidita mía. Necesitas un poco de paz.',
            ],
            'Colega sarcástico' => [
                'Vaya, alguien ha descubierto que el café no sustituye al sueño.',
                '¡Miradlo! Produciendo como si le pagaran millones.',
                'Tu nivel de estrés es tan alto que hasta yo estoy nervioso.',
            ]
        ];

        $personalityResponses = $responses[$personality] ?? $responses['Colega sarcástico'];
        
        if ($energy < 30) return $personalityResponses[0];
        if ($foco > 70) return $personalityResponses[1];
        return $personalityResponses[2];
    }
}
