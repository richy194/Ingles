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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('codigo');
            $table->string('descripcion');
            $table->string('nivel_curso');
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->foreignId('semestre_id')->constrained('semestres')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('teacher_id')->constrained('theachers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
