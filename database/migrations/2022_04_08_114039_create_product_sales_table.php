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
        Schema::create('product_sales', function (Blueprint $table) {
            $table->id();
            $table->text('cashier_name')->nullable();
            $table->text('product_name');
            $table->text('product_id');
            $table->boolean('on_hold')->default(false);
            $table->boolean('returned')->default(false);
            $table->double('selling_price')->default(0);
            $table->integer('quantity')->default(1);
            $table->double('cost_price')->default(0);
            $table->double('profit_margin')->default(0);
            $table->double('total_cost')->default(0);
            $table->unsignedBigInteger('reg_by');
            $table->foreign('reg_by')->references('id')->on('users');
            $table->string('sale_id');
            $table->foreign('sale_id')->references('sales_id')->on('sales');
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
        Schema::dropIfExists('product_sales');
    }
};
