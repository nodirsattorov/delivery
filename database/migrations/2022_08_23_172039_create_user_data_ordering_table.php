<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDataOrderingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data_ordering', function (Blueprint $table) {
            $table->integer('id', true)->unique('id');
            $table->bigInteger('tg_user_id');
            $table->text('address');
            $table->string('order_type', 50)->nullable();
            $table->string('order_time', 10)->nullable();
            $table->text('lotitude');
            $table->text('longtitude');
            $table->string('payment', 50);
            $table->text('comment');
            $table->integer('dostavka_summa')->default(0);
            $table->integer('distance')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_data_ordering');
    }
}
