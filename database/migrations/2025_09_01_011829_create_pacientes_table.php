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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ap_paterno')->nullable();
            $table->string('ap_materno')->unique();
            $table->string('mobile')->nullable();
            $table->enum('gender',['m','f']);
            $table->string('etnia')->nullable();
            $table->string('n_document')->nullable();
            $table->timestamp('fecha_nac')->nullable();
            $table->string('address')->nullable();
            $table->longText('education')->nullable();
            $table->longText('education')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
