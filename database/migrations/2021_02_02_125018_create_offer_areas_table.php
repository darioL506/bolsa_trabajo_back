<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferAreasTable extends Migration
{
    /**
     * Run the migrations.
     * Tabla que relaciona las ofertas con las areas de estudio mediante company_id y area_id
     * @return void
     */
    public function up()
    {
        Schema::create('offer_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')
                    ->constrained('offers')
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
        Schema::dropIfExists('offer_areas');
    }

}
