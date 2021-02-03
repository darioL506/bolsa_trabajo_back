<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     * Tabla para ver la seleccion de las ofertas
     * El campo sendTo es un booleano, que hace
     *  0 Enviado desde la empresa
     *  1 Enviado desde el alumno
     * El campo isAccepted es otro booleano con los siguiente valores
     *  0 Esperando sin aceptar
     *  1 Aceptado
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                    ->constrained('students')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->foreignId('offer_id')
                    ->constrained('offers')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->integer('send_to')->nullable();
            $table->integer('isActive')->default(0);
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
        Schema::dropIfExists('interviews', function (Blueprint $table) {
            $table->dropForeign(['student_id', 'offer_id']);
        });
    }
}
