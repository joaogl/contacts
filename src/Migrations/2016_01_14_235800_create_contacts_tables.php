<?php

use Illuminate\Database\Migrations\Migration;
use \jlourenco\base\Database\Blueprint;

class CreateContactsTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('ContactType', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('icon', 50)->nullable();
            $table->string('color_c', 6)->nullable();
            $table->string('color_hc', 6)->nullable();
            $table->string('description', 250);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('Contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contact_reference', 50);
            $table->integer('contacttype')->unsigned();
            $table->string('contact', 250);
            $table->tinyInteger('visibility');
            $table->timestamps();
            $table->softDeletes();
            $table->creation();

            $table->foreign('contacttype')->references('id')->on('ContactType');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('Contact');
        Schema::drop('ContactType');

    }

}
