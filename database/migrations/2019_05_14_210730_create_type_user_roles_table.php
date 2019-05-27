<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeUserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_user_roles', function (Blueprint $table) {
            $table->unsignedInteger('type_user_id');
            $table->unsignedInteger('role_id');
            $table->timestamps();
            $table->foreign('type_user_id')->references('id')->on('type_user');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->index(['type_user_id', 'role_id']);

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
        Schema::dropIfExists('type_user_roles');
        Schema::enableForeignKeyConstraints();
    }
}
