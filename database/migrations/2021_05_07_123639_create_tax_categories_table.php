<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name')->unique();
            $table->longtext('description');
            $table->timestamps();
        });

        Schema::create('tax_categories_tax_rates', function (Blueprint $table) {
            $table->id();
            $table->integer('tax_category_id')->unsigned();
            $table->foreign('tax_category_id')->references('id')->on('tax_categories')->onDelete('cascade');
            $table->integer('tax_rate_id')->unsigned();
            $table->foreign('tax_rate_id')->references('id')->on('tax_rates')->onDelete('cascade');
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
        Schema::dropIfExists('tax_categories');
        Schema::dropIfExists('tax_categories_tax_rates');
    }
}
