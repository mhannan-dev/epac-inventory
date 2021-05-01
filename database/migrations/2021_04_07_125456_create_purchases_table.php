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
            $table->increments('id');
            $table->integer('supplier_id')->unsigned()->comment('PK on suppliers table');
            $table->integer('unit_id')->unsigned()->comment('PK on units table');
            $table->integer('product_id')->unsigned()->comment('PK on products table');
            $table->double('buying_qty', 20, 2);
            $table->double('unit_price', 20, 2);
            $table->double('unt_sell_price', 20, 2);
            $table->double('buying_price', 20, 2);
            $table->text('description');
            $table->tinyInteger('status');
            $table->date('date');
            $table->integer('created_by');
            $table->timestamps();
        });
        Schema::table('purchases', function($table) {
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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
