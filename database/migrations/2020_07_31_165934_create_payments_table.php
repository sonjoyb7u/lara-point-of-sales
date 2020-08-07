<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->string('paid_status', 50)->nullable();
            $table->decimal('paid_amount', '10', '2')->default('0.00');
            $table->decimal('due_amount', '10', '2')->default('0.00');
            $table->decimal('total_amount', '10', '2')->default('0.00');
            $table->decimal('discount_amount', '10', '2')->default('0.00');
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
        Schema::dropIfExists('payments');
    }
}
