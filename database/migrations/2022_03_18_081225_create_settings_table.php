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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('business_name')->default('Inventory');
            $table->string('contact_phone')->default('');
            $table->string('contact_email')->default('');
            $table->text('receipt_message');
            $table->string('currency')->default('NGN');
            $table->double('low_product_alert')->default(50);
            $table->text('business_address');
            $table->string('primary_color')->defult('#000');
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
        Schema::dropIfExists('settings');
    }
};
