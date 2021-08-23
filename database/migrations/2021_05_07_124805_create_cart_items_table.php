<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('quantity')->unsigned()->default(0);
            $table->string('sku')->nullable();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('coupon_code')->nullable();
            $table->decimal('weight', 12,4)->default(1);
            $table->decimal('total_weight', 12,4)->default(0);
            $table->decimal('base_total_weight', 12,4)->default(0);
            
            $table->decimal('price', 12,2)->default(1);
            $table->decimal('base_price', 12,2)->default(0);
            $table->decimal('custom_price', 12,2)->default(0);

            $table->decimal('total', 12,2)->default(0);
            $table->decimal('base_total', 12,2)->default(0);

            $table->decimal('tax_percent', 12, 2)->default(0)->nullable();
            $table->decimal('tax_amount', 12, 2)->default(0)->nullable();
            $table->decimal('base_tax_amount', 12, 2)->default(0)->nullable();
            
            $table->decimal('discount_percent', 12,2)->default(0);
            $table->decimal('discount_amount', 12,2)->default(0);
            $table->decimal('base_discount_amount', 12,2)->default(0);

            $table->json('additional')->nullable();

            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('cart_id');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->unsignedInteger('tax_category_id')->nullable();
            $table->foreign('tax_category_id')->references('id')->on('tax_categories');
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
        Schema::dropIfExists('cart_items');
    }
}
