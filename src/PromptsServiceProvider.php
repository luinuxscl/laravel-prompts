<?php

namespace Luinuxscl\LaravelPrompts;

use Illuminate\Support\ServiceProvider;

class PromptsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publicar migraciones
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations' => database_path('migrations'),
            ], 'migrations');
            
            // Publicar archivo de configuración si lo necesitas
            $this->publishes([
                __DIR__ . '/../config/prompts.php' => config_path('prompts.php'),
            ], 'config');
        }
    }

    public function register()
    {
        // Fusionar configuración predeterminada, si aplica
        $this->mergeConfigFrom(__DIR__ . '/../config/prompts.php', 'prompts');
        
        // Registrar bindings o singletons para la integración de prompts y LLM
        $this->app->singleton('prompt.integration', function ($app) {
            return new Services\PromptIntegrationService();
        });
    }
}
