<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //---------------------
        Schema::create('Projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tags_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->foreignId('environment_id')->constrained()->onDelete('cascade');
            $table->foreignId('resources_id')->constrained()->onDelete('cascade');
            $table->foreignId('mechanism_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('logo');
            $table->string('description');
            $table->string('abstract');
            $table->string('overview');
            $table->string('image');
            $table->string('objectives');
            $table->string('content');
            $table->string('waypoints');
            $table->string('launched');
            $table->string('proponent');
            $table->string('progress');
            $table->string('problems');
            $table->string('solutions');
            $table->string('completion');
            $table->string('impact');
            $table->string('output');
            $table->string('costing');
            $table->string('future');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Projects');
    }
};
