<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tg_user_id');
            $table->string('menu');
            $table->string('lang', 10);
            $table->integer('product_id')->default(0);
            $table->integer('cotegory_id')->default(0);
            $table->string('price_type')->nullable();
            $table->integer('menu_id')->default(0);
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
        Schema::dropIfExists('current');
    }
}
