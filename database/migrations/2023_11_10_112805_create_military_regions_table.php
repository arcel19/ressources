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
        Schema::create('military_regions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city');
            $table->string('location');
            $table->foreignId('nationalArmy_id')->references('id')->on('national_armies')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('military_regions');
    }
};
