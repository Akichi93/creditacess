<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCongesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('respo_id');

            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('duree');
            $table->string('date_retour');
            $table->integer('etat')->default(0)->comment('0 = encours, 1 = accepte, 2 = refuse, 3 = valide');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('respo_id')
                ->references('id')
                ->on('respos')
                ->onDelete('cascade');
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conges');
    }
}
