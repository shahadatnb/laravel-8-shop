<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id',2);
            $table->string('lebel',80);
            $table->string('menu_url',80);
            $table->string('menu_class',80)->nullable();
            $table->string('menu_role',80)->nullable();
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->unsignedMediumInteger('sl')->default(0);
            $table->string('menuType',20)->nullable();
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
        Schema::dropIfExists('menu_items');
    }
}
