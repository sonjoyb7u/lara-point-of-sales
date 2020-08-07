<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('sub_category_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned();
            $table->string('purchase_no');
            $table->dateTime('purchase_date');
            $table->string('desc')->nullable();
            $table->decimal('unit_price', 10, 2);
            $table->decimal('buying_qty', 10, 2)->default(0.00);
            $table->decimal('buying_price', 10, 2);
            $table->enum('purchase_status', ['pending', 'approved', 'return'])->default('pending');
            $table->string('created_by', 50)->nullable();
            $table->string('updated_by', 50)->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
