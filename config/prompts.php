<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Configuración por defecto para los LLM
    |--------------------------------------------------------------------------
    |
    | Aquí puedes especificar el cliente LLM por defecto y sus configuraciones.
    | Opciones disponibles: 'openai', 'openrouter', o cualquier otro que implementes.
    |
    */

    'default_llm' => env('PROMPTS_DEFAULT_LLM', 'openai'),

    /*
    |--------------------------------------------------------------------------
    | Configuración de OpenAI
    |--------------------------------------------------------------------------
    |
    | Configuración específica para el cliente de OpenAI.
    |
    */
    'openai' => [
        'model' => env('OPENAI_MODEL', 'gpt-3.5-turbo'),
        'temperature' => env('OPENAI_TEMPERATURE', 0.7),
        'max_tokens' => env('OPENAI_MAX_TOKENS', 500),
        'system_prompt' => env('OPENAI_SYSTEM_PROMPT', 'Eres un asistente útil.'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Configuración de Patrones de Reemplazo
    |--------------------------------------------------------------------------
    |
    | Define el patrón que se usará para identificar dónde se deben insertar
    | prompts secundarios en un prompt principal.
    |
    */
    'placeholder_pattern' => '/\{(\w+)\}/',
];
