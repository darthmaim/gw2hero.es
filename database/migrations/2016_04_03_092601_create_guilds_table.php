<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guilds', function (Blueprint $table) {
            $table->increments('id');

            $table->string('guid', 36);
            $table->string('name');
            $table->string('tag');
            $table->integer('member_count');
            $table->integer('member_capacity');
            $table->text('emblem');
            $table->integer('level');
            $table->integer('influence');
            $table->integer('aetherium');
            $table->integer('resonance');
            $table->integer('favor');
            $table->text('motd');
            $table->boolean('authorized');
            $table->boolean('public');

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
        Schema::drop('guilds');
    }
}
