<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDuoPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duo_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('now_league_id')->default(0);
            $table->integer('now_division_id')->default(0);
            $table->integer('next_league_id')->default(0);
            $table->integer('next_division_id')->default(0);
            $table->float('price', 8, 2)->default(0);
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
        Schema::dropIfExists('duo_prices');
    }
}
