<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned()->nullable(false);
            $table->bigInteger('product_id')->unsigned()->nullable(false);
            $table->string('title')->nullable(false);
            $table->string('category')->nullable(false);
            $table->decimal('regular_price')->nullable(false);
            $table->decimal('discount_price')->nullable(false);
            $table->decimal('price')->nullable(false);
            $table->bigInteger('promo_code_id')->unsigned()->nullable();
            // $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('promo_code_id')->references('id')->on('promo_codes');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_details');
    }
}
