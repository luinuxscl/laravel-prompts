# Laravel Prompts Package

Este package permite almacenar y combinar prompts dinámicamente, integrándolos con LLMs (como Laravel OpenAI o OpenRouter). Además, protege los prompts que están siendo utilizados en otros de ser eliminados.

## Instalación

1. Instala el package vía Composer:
   ```
   composer require luinuxscl/laravel-prompts
   ```

2. Publica las migraciones y configuración:
   ```
   php artisan vendor:publish --provider="Luinuxscl\LaravelPrompts\PromptsServiceProvider" --tag=migrations
   php artisan vendor:publish --provider="Luinuxscl\LaravelPrompts\PromptsServiceProvider" --tag=config
   ```

3. Ejecuta las migraciones:
   ```
   php artisan migrate
   ```

## Uso

### Almacenamiento de Prompts

```php
use Luinuxscl\LaravelPrompts\Models\Prompt;

// Crear un prompt simple
$prompt1 = Prompt::create([
    'title' => 'Saludo',
    'content' => 'Hola, mi nombre es {nombre}.'
]);

// Crear otro prompt que se usará como componente
$prompt2 = Prompt::create([
    'title' => 'Información adicional',
    'content' => 'Tengo {edad} años y vivo en {ciudad}.'
]);
```

### Integración de Prompts

```php
use Luinuxscl\LaravelPrompts\Models\Prompt;
use Luinuxscl\LaravelPrompts\Models\PromptReference;
use Luinuxscl\LaravelPrompts\Services\PromptIntegrationService;

// Crear un prompt principal que integra otros prompts
$promptPrincipal = Prompt::create([
    'title' => 'Presentación completa',
    'content' => '{saludo} Adicionalmente, {info_adicional}'
]);

// Registrar las relaciones entre prompts
PromptReference::create([
    'parent_prompt_id' => $promptPrincipal->id,
    'child_prompt_id' => $prompt1->id  // Prompt "Saludo"
]);

PromptReference::create([
    'parent_prompt_id' => $promptPrincipal->id,
    'child_prompt_id' => $prompt2->id  // Prompt "Información adicional"
]);

// Usar el servicio para integrar prompts
$promptService = app('prompt.integration');

$promptFinal = $promptService->integratePrompts(
    $promptPrincipal->content,
    [
        'saludo' => $prompt1->content,
        'info_adicional' => $prompt2->content
    ]
);

// Resultado: "Hola, mi nombre es {nombre}. Adicionalmente, Tengo {edad} años y vivo en {ciudad}."

// Integrar con datos reales
$promptConDatos = $promptService->integratePrompts(
    $promptFinal,
    [
        'nombre' => 'Luis',
        'edad' => '30',
        'ciudad' => 'Santiago'
    ]
);

// Resultado final: "Hola, mi nombre es Luis. Adicionalmente, Tengo 30 años y vivo en Santiago."
```

## Características

- Almacenamiento de prompts en base de datos
- Combinación dinámica de prompts usando placeholders
- Protección contra eliminación de prompts en uso
- Configuración flexible a través de archivo de configuración

## Contribuciones

Las contribuciones son bienvenidas. Por favor, revisa las issues en GitHub para ver cómo puedes ayudar.

## Licencia

Este package está licenciado bajo [MIT license](./LICENSE).
