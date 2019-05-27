<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_notes', function (Blueprint $table) {
            $table->unsignedInteger('contact_id');
            $table->unsignedInteger('note_id');
            $table->timestamps();
            $table->foreign('contact_id')->references('id')->on('contacts');
            $table->foreign('note_id')->references('id')->on('notes');
            $table->index(['contact_id', 'note_id']);

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
        Schema::dropIfExists('contact_notes');
        Schema::enableForeignKeyConstraints();
    }
}
