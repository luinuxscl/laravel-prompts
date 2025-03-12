<?php

namespace Luinuxscl\LaravelPrompts\Services\LLMClients;

use Luinuxscl\LaravelPrompts\Contracts\LLMClientInterface;
use OpenAI\Laravel\Facades\OpenAI;

class OpenAIClient implements LLMClientInterface
{
    public function sendPrompt(string $prompt): array
    {
        return OpenAI::chat([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'Eres un asistente útil.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);
    }
}
