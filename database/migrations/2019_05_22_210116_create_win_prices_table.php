<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWinPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('win_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('now_league_id')->default(0);
            $table->integer('now_division_id')->default(0);
            $table->integer('games')->default(0);
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
        Schema::dropIfExists('win_prices');
    }
}
