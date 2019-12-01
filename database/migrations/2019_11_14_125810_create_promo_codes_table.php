<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',50)->nullable(false);
            $table->string('name',50)->nullable(false);
            $table->integer('uses')->unsigned()->nullable(false);
            $table->integer('max_uses')->unsigned()->nullable(false);
            $table->integer('max_uses_user')->unsigned()->nullable(false);
            $table->integer('minimum_order_value')->unsigned()->nullable(false);
            $table->integer('minimum_order_product')->unsigned()->nullable(false);
            $table->integer('maximum_discount_amount')->unsigned()->nullable(false);
            $table->date('starts_at')->nullable(false);
            $table->date('expires_at')->nullable(false);
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
        Schema::dropIfExists('promo_codes');
    }
}
