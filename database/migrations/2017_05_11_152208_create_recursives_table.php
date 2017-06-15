<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecursivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recursives', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('categorie_id');
            $table->tinyInteger('user_id');
            $table->text('name');
            $table->tinyInteger('action');
            $table->text('value');
            $table->tinyInteger('active');
            $table->dateTime('date');
            $table->dateTime('expire');
            $table->tinyInteger('period');
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
        Schema::dropIfExists('recursives');
    }
}
