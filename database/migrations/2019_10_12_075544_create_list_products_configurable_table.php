<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListProductsConfigurableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_products_configurable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_configurable_id')->unsigned()->nullable(false);
            $table->bigInteger('product_id')->unsigned()->nullable(false);

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('product_configurable_id')->references('id')->on('products_configurable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_products_configurable');
    }
}
