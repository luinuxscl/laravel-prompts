<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromptReferencesTable extends Migration
{
    public function up()
    {
        Schema::create('prompt_references', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_prompt_id');
            $table->unsignedBigInteger('child_prompt_id');
            $table->timestamps();

            $table->foreign('parent_prompt_id')->references('id')->on('prompts')->onDelete('cascade');
            $table->foreign('child_prompt_id')->references('id')->on('prompts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('prompt_references');
    }
}
