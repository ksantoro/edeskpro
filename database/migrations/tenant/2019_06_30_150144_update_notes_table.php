<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('description');
            $table->integer('entity_type_id')->after('id');
            $table->integer('entity_id')->after('entity_type_id');
            $table->string('note')->after('entity_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn('entity_type_id');
            $table->dropColumn('entity_id');
            $table->dropColumn('notes');
            $table->string('name')->after('id');
            $table->string('description')->after('name');
        });
    }
}
