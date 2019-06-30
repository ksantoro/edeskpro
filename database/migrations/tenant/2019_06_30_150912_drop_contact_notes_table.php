<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropContactNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('contact_notes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('contact_notes', function (Blueprint $table) {
            $table->integer('contact_id');
            $table->integer('note_id');
            $table->timestamps();
            $table->unique(['contact_id', 'note_id']);

            $table->engine    = 'InnoDB';
            $table->charset   = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }
}