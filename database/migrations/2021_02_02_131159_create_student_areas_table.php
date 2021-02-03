<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAreasTable extends Migration
{
    /**
     * Run the migrations.
     * Tabla para relacionar a los estudiantes con sus areas de estudio mediante user_id y area_id
     * @return void
     */
    public function up()
    {
        Schema::create('student_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('area_id')
                    ->constrained('areas')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_areas', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'areas']);
        });
    }
}
