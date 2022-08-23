<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('botusers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('tg_user_id');
            $table->string('name');
            $table->string('phone', 20);
            $table->boolean('sendmessage')->nullable()->default(true);
            $table->string('address')->nullable();
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
        Schema::dropIfExists('botusers');
    }
}
