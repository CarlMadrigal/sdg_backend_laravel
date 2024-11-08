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
        Schema::create('Mechanism', function (Blueprint $table) {
            $table->id();
            $table->string('plannig');
            $table->string('design');
            $table->string('installation');
            $table->string('testing');
            $table->string('monitoring');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Mechanism');
    }
};
