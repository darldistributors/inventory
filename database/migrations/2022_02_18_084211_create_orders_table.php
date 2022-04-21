<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('product_name');
            $table->date('order_date');
            $table->double('quantity')->default(0);
            $table->double('total')->default(0);
            $table->double('discount')->default(0);
            $table->unsignedBigInteger('reg_by');
            $table->boolean('confirmed_order')->default(false);
            $table->unsignedBigInteger('confirmed_by')->nullable();
            $table->string('supplier_name');
            $table->string('supplier_phone');
            $table->timestamp('confirm_date')->nullable(true);
            $table->foreign('reg_by')->references('id')->on('users');
            $table->foreign('confirmed_by')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
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
};
