<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('status')->nullable();

            $table->boolean('payment_status')->default(0);
            $table->boolean('refund_status')->default(0);
            $table->string('payment_method')->nullable();
            $table->string('payment_method_title')->nullable();

            $table->boolean('shipping_status')->default(0);
            $table->string('carrier_code')->nullable();
            $table->string('carrier_title')->nullable();
            $table->text('track_number')->nullable();

            $table->boolean('is_guest')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_first_name')->nullable();
            $table->string('customer_last_name')->nullable();

            $table->string('shipping_method')->nullable();
            $table->string('shipping_title')->nullable();
            $table->string('shipping_description')->nullable();
            $table->string('coupon_code')->nullable();
            $table->boolean('is_gift')->default(0);

            $table->unsignedInteger('total_item_count')->nullable();
            $table->unsignedInteger('total_qty_ordered')->nullable();

            $table->string('base_currency_code')->nullable();
            $table->string('order_currency_code')->nullable();

            $table->decimal('grand_total', 12, 2)->default(0)->nullable();
            $table->decimal('base_grand_total', 12, 2)->default(0)->nullable();
            $table->decimal('grand_total_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('base_grand_total_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('grand_total_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('base_grand_total_refunded', 12, 2)->default(0)->nullable();

            $table->decimal('sub_total', 12, 2)->default(0)->nullable();
            $table->decimal('base_sub_total', 12, 2)->default(0)->nullable();
            $table->decimal('sub_total_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('base_sub_total_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('sub_total_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('base_sub_total_refunded', 12, 2)->default(0)->nullable();

            $table->decimal('discount_percent', 12, 2)->default(0)->nullable();
            $table->decimal('discount_amount', 12, 2)->default(0)->nullable();
            $table->decimal('base_discount_amount', 12, 2)->default(0)->nullable();
            $table->decimal('discount_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('base_discount_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('discount_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('base_discount_refunded', 12, 2)->default(0)->nullable();

            $table->decimal('tax_amount', 12, 2)->default(0)->nullable();
            $table->decimal('base_tax_amount', 12, 2)->default(0)->nullable();
            $table->decimal('tax_amount_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('base_tax_amount_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('tax_amount_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('base_tax_amount_refunded', 12, 2)->default(0)->nullable();

            $table->decimal('shipping_amount', 12, 2)->default(0)->nullable();
            $table->decimal('base_shipping_amount', 12, 2)->default(0)->nullable();
            $table->decimal('shipping_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('base_shipping_invoiced', 12, 2)->default(0)->nullable();
            $table->decimal('shipping_refunded', 12, 2)->default(0)->nullable();
            $table->decimal('base_shipping_refunded', 12, 2)->default(0)->nullable();

            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('customer_type')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
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
        Schema::dropIfExists('orders');
    }
}
