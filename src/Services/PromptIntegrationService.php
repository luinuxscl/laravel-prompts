<?php

namespace Luinuxscl\LaravelPrompts\Services;

use Exception;

class PromptIntegrationService
{
    /**
     * Integra los prompts adicionales en el prompt principal.
     *
     * @param string $mainPrompt
     * @param array $additionalPrompts (ejemplo: ['prompt2' => 'contenido2', 'prompt3' => 'contenido3'])
     * @return string
     */
    public function integratePrompts(string $mainPrompt, array $additionalPrompts): string
    {
        return preg_replace_callback('/\{(\w+)\}/', function ($matches) use ($additionalPrompts) {
            $clave = $matches[1];
            return $additionalPrompts[$clave] ?? $matches[0];
        }, $mainPrompt);
    }

    /**
     * Envía el prompt final a un LLM.
     * Este método es abstracto; puedes inyectar tu cliente (Laravel OpenAI, OpenRouter, etc.)
     *
     * @param string $finalPrompt
     * @param object $llmClient (cliente del LLM)
     * @return array
     */
    public function processPromptWithLLM(string $finalPrompt, $llmClient): array
    {
        // Ejemplo usando Laravel OpenAI
        return $llmClient->chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'Eres un asistente útil.'],
                ['role' => 'user', 'content' => $finalPrompt],
            ],
        ]);
    }
}
