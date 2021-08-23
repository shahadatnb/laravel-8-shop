<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedTinyInteger('status')->default(0);
            $table->unsignedInteger('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('store_id')->nullable();            
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
            
            $table->string('title')->nullable();
            $table->string('slug')->nullable()->unique();;
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->boolean('new')->nullable();
            $table->boolean('featured')->nullable();
            $table->string('thumbnail')->nullable();

            $table->boolean('stockOutSell')->nullable()->default(0);
            $table->boolean('trackQuantity')->nullable()->default(0);
            $table->boolean('readyToShipping')->nullable()->default(0);
            $table->boolean('noShappingCharge')->nullable()->default(0);            
            $table->decimal('qty',12,4)->nullable()->default(0);
            
            $table->string('sku')->nullable()->unique();
            $table->string('barcode')->nullable();

            $table->decimal('price', 12, 4)->nullable();
            $table->decimal('cost', 12, 4)->nullable();
            $table->decimal('special_price', 12, 4)->nullable();
            $table->date('special_price_from')->nullable();
            $table->date('special_price_to')->nullable();

            $table->decimal('weight', 12, 4)->nullable();
            $table->integer('color')->nullable();
            $table->string('color_label')->nullable();
            $table->integer('size')->nullable();
            $table->integer('size_label')->nullable();

            //$table->integer('attribute_family_id')->unsigned()->nullable();
            //$table->foreign('attribute_family_id')->references('id')->on('attribute_families')->onDelete('restrict');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('category_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('product_attribute_options', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('attribute_option_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('attribute_option_id')->references('id')->on('attribute_options')->onDelete('cascade');
        });

        Schema::create('product_relations', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('child_id');
            $table->foreign('parent_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_attributes', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('attribute_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('restrict');
        });

        Schema::create('product_up_sells', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('child_id');
            $table->foreign('parent_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('products')->onDelete('cascade');
        });

        Schema::create('product_cross_sells', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id');
            $table->unsignedBigInteger('child_id');
            $table->foreign('parent_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('products')->onDelete('cascade');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_cross_sells');

        Schema::dropIfExists('product_up_sells');

        Schema::dropIfExists('product_attributes');

        Schema::dropIfExists('product_relations');

        Schema::dropIfExists('product_categories');

        Schema::dropIfExists('products');
    }
}
