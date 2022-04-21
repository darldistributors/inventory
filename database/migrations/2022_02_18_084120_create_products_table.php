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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->unsignedBigInteger('category_id');
            // $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('reg_by');
            $table->double('unit_cost')->default(0);
            $table->string('supplier_name');
            $table->string('supplier_phone');
            $table->string('comapnay_name');
            $table->string('company_address');
            $table->double('in_stock')->default(0);
            $table->double('selling_price')->default(0);
            $table->boolean('out_of_stock')->default(true);
            $table->timestamps();
            // $table->foreign('category_id')->references('id')->on('categories');
            // $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('reg_by')->references('id')->on('users');
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
};
