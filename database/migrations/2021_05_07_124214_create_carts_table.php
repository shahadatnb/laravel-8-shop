<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cartType')->nullable();
            $table->string('shipping_method')->nullable();
            $table->string('coupon_code')->nullable();
            $table->decimal('exchange_rate', 12, 4)->nullable();
            $table->string('global_currency_code')->nullable();
            $table->string('base_currency_code')->nullable();
            $table->string('cart_currency_code')->nullable();

            $table->decimal('tax_total', 12, 4)->default(0)->nullable();
            $table->decimal('base_tax_total', 12, 4)->default(0)->nullable();

            $table->decimal('discount', 12, 4)->default(0)->nullable();
            $table->decimal('base_discount', 12, 4)->default(0)->nullable();

            $table->string('checkout_method')->nullable();
            $table->boolean('is_guest')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->dateTime('conversion_time')->nullable();

            $table->unsignedInteger('customer_id')->unsigned()->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('carts');
    }
}
