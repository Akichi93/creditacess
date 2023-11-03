<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToConges extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conges', function (Blueprint $table) {
            $table->longText('motif')->after('respo_id')->nullable();
            $table->longText('motif_etat')->after('motif')->nullable();
            $table->string('type_conge')->after('motif_etat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conges', function (Blueprint $table) {
            //
        });
    }
}
