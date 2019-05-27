<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contact_type_id')->default(0);
            $table->string('first_name', 64)->default('');
            $table->string('last_name', 64)->default('');
            $table->string('title', 64)->default('')->nullable();
            $table->string('phone', 64)->default('');
            $table->unsignedInteger('phone_type_id')->default(1);
            $table->string('email', 256)->default('');
            $table->unsignedInteger('email_type_id')->default(1);
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('contacts');
        Schema::enableForeignKeyConstraints();
    }
}
