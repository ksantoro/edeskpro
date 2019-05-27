<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contact_id')->default(0);
            $table->boolean('is_billing')->default(0);
            $table->integer('contact_method_type_id');
            $table->string('street');
            $table->string('suite')->default('')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip');
            $table->string('country')->default('US');
            $table->timestamps();
            $table->softDeletes();

            $table->engine    = 'InnoDB';
            $table->charset   = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });

        Schema::create('contacts_locations', function (Blueprint $table) {
            $table->unsignedInteger('location_id');
            $table->unsignedInteger('contact_id');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->timestamps();

            $table->engine    = 'InnoDB';
            $table->charset   = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('locations');
        Schema::dropIfExists('contacts_locations');
        Schema::enableForeignKeyConstraints();
    }
}
