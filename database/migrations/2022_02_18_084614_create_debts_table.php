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
        Schema::create('debts', function (Blueprint $table) {
            $table->id();
            $table->string('debt_id')->nullable();
            $table->text('description');
            $table->double('initial_amount')->default(0);
            $table->double('total_debt_before')->default(0);
            $table->double('total_debt_after')->default(0);
            $table->double('amount_paid')->default(0);
            $table->string('debt_type'); // sales, general
            $table->unsignedBigInteger('reg_by');
            // $table->foreign('order_id')->references('id')->on('orders');
            // $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('reg_by')->references('id')->on('users');
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
        Schema::dropIfExists('debts');
    }
};
