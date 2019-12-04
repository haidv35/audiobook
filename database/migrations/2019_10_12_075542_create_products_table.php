<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type',['simple','configurable'])->nullable(false);
            $table->bigInteger('user_id')->unsigned()->nullable(false);
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->string('title')->nullable(false)->default('0');
            $table->text('short_description')->nullable(false);
            $table->string('image')->nullable(false)->default('0');
            $table->string('demo_link')->nullable(false)->default(0)->default('0');
            $table->decimal('regular_price',8)->nullable(false)->default(0);
            $table->decimal('discount_price',8)->nullable(false)->default(0);
            $table->boolean('new_product')->nullable(false)->default(false);
            $table->boolean('hot_product')->nullable(false)->default(false);
            $table->integer('qty_purchased')->nullable(false)->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
