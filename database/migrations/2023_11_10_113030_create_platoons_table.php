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
        Schema::create('platoons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('functionality');
            $table->foreignId('unitCompany_id')->references('id')->on('unit_companies')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platoons');
    }
};
