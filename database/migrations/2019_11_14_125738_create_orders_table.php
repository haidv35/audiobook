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
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable(false);
            $table->string('order_code',100)->nullable(false);
            $table->enum('status',['unpaid','processing','paid','canceled'])->nullable(false);
            $table->decimal('amount')->nullable(false);
            $table->decimal('paid')->nullable(false);
            $table->bigInteger('payment_method_id')->unsigned()->nullable();
            $table->dateTime('ordered_at')->nullable(false);
            $table->dateTime('paid_at')->nullable(false);
            $table->dateTime('canceled_at')->nullable(false);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');

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
