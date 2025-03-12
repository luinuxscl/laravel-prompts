<?php

namespace Luinuxscl\LaravelPrompts\Contracts;

interface LLMClientInterface
{
    /**
     * Envía un prompt al LLM y devuelve la respuesta.
     *
     * @param string $prompt
     * @return array
     */
    public function sendPrompt(string $prompt): array;
}
