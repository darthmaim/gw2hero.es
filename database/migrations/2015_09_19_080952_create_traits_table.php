<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traits', function (Blueprint $table) {
            $table->integer('id');

            $table->integer('specialization_id');
            $table->integer('tier');
            $table->string('slot');

            $table->string('name_de');
            $table->string('name_en');
            $table->string('name_es');
            $table->string('name_fr');

            $table->json('data_de');
            $table->json('data_en');
            $table->json('data_es');
            $table->json('data_fr');

            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('traits');
    }
}
