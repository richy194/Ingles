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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->foreignId('curso_id')->constrained('cursos')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('periodo_id')->constrained('periodo_academicos')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('cantidad');
            $table->foreignId('teacher_id')->constrained('theachers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
