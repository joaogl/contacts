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
            $table->text('html')->nullable();
            $table->string('description', 250);

            $table->timestamps();
            $table->softDeletes();
            $table->creation();
        });

        Schema::create('Contact', function (Blueprint $table) {
            $table->increments('id');
            $table->string('contact_reference', 50);
            $table->integer('contacttype')->unsigned();
            $table->string('contact', 250);
            $table->text('permissions');

            $table->timestamps();
            $table->softDeletes();
            $table->creation();

            $table->foreign('contacttype')->references('id')->on('ContactType');
        });

        Schema::create('Contact_Entity', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contact')->unsigned();
            $table->morphs("entity");

            $table->timestamps();
            $table->softDeletes();
            $table->creation();

            $table->foreign('contact')->references('id')->on('Contact');
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
