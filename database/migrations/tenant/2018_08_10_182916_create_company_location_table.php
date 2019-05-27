<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_location', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id');
            $table->boolean('is_billing')->default(0);
            $table->boolean('is_corporate')->default(0);
            $table->boolean('is_delivery')->default(0);
            $table->string('street');
            $table->string('suite');
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_location');
    }
}
