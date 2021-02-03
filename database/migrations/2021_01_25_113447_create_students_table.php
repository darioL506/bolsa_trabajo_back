<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     * Tabla que crea el perfil de estudiantes, relacionando el user_id
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name',250);
            $table->string('lastnames',250);
            $table->string('dni',9)->unique();
            $table->foreignId('user_id')
                    ->constrained('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->date('birthdate');
            $table->integer('phone');
            $table->string('aptitudes',500);
            $table->boolean('isActive')->default(0);
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
        Schema::dropIfExists('students', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
}
