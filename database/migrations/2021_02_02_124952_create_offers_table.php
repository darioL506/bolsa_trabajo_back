<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     * Tabla que crea las ofertas de empleo de las empresas
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('vacant');
            $table->date('startDate');
            $table->date('endDate');
            $table->string('description', 200);
            $table->boolean('isActive')->default(0);
            $table->foreignId('company_id')
                    ->constrained('companies')
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
        Schema::dropIfExists('offers', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
        });
    }
}
