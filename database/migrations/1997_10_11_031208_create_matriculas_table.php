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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_matricula')->requireed();
            $table->string('estado');
            $table->integer('nota_final');
            $table->foreignId('teacher_id')->constrained('theachers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('grupo_id')->constrained('cursos')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnUpdate()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
