<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('jowi_order_id')->nullable();
            $table->string('bill_id')->nullable();
            $table->bigInteger('tg_user_id');
            $table->text('address');
            $table->string('latitude', 30);
            $table->string('longitude', 30);
            $table->integer('summa');
            $table->integer('d_price')->default(0);
            $table->integer('payment_fromcash')->default(0);
            $table->integer('cashback')->default(0);
            $table->text('comment');
            $table->integer('number_of_products');
            $table->string('status', 30);
            $table->boolean('status_admin')->default(false);
            $table->tinyInteger('is_send')->default(0);
            $table->integer('status_otziv')->default(0);
            $table->integer('payment');
            $table->string('payment_method', 200);
            $table->string('order_type', 50)->nullable();
            $table->string('order_time', 50)->nullable();
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
