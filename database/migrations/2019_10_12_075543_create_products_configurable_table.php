<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsConfigurableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_configurable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_configurable_id')->unsigned()->nullable(false);
            $table->bigInteger('product_simple_id')->unsigned()->nullable(false);

            $table->foreign('product_configurable_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('product_simple_id')->references('id')->on('products')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_configurable');
    }
}
