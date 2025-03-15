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
}
