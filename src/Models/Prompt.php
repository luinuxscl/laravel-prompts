<?php

namespace Luinuxscl\LaravelPrompts\Models;

use Illuminate\Database\Eloquent\Model;
use Exception;

class Prompt extends Model
{
    protected $fillable = ['title', 'content'];

    // Relación para saber en qué otros prompts es utilizado
    public function usedIn()
    {
        return $this->hasMany(PromptReference::class, 'child_prompt_id');
    }

    protected static function booted()
    {
        static::deleting(function ($prompt) {
            // Comprobar si el prompt está referenciado en otro prompt
            if ($prompt->usedIn()->exists()) {
                throw new Exception("No se puede eliminar este prompt porque está siendo utilizado en otro prompt.");
            }
        });
    }
}
