<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default(0);
            $table->string('paypal_id')->default('');
            $table->enum('type', ['coaching', 'solo', 'duo', 'win'])->default('coaching');
            $table->enum('service', ['regular', 'premium'])->default('regular');
            $table->string('line')->default('');
            $table->enum('rank', ['diamond', 'master', 'challenger'])->default('diamond');
            $table->integer('server_id')->default(0);
            $table->integer('hours')->default(0);
            $table->integer('now_league_id')->default(0);
            $table->integer('now_division_id')->default(0);
            $table->integer('next_league_id')->default(0);
            $table->integer('next_division_id')->default(0);
            $table->integer('queue_id')->default(0);
            $table->enum('game_service', ['solo', 'duo'])->default('solo');
            $table->integer('games')->default(0);
            $table->float('price', 8, 2)->default(0);
            $table->enum('pay_status', ['yes', 'no'])->default('no');
            $table->enum('status', ['process', 'done', 'cancel'])->default('cancel');
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
        Schema::dropIfExists('orders');
    }
}
