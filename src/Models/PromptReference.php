<?php

namespace Luinuxscl\LaravelPrompts\Models;

use Illuminate\Database\Eloquent\Model;

class PromptReference extends Model
{
    protected $fillable = ['parent_prompt_id', 'child_prompt_id'];

    public function parentPrompt()
    {
        return $this->belongsTo(Prompt::class, 'parent_prompt_id');
    }

    public function childPrompt()
    {
        return $this->belongsTo(Prompt::class, 'child_prompt_id');
    }
}
