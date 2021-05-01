<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('invoice_id')->unsigned()->comment('PK on invoice table');
          $table->integer('product_id')->unsigned()->comment('PK on product table');
          $table->string('name',200)->nullable();
          $table->date('date');
          $table->double('selling_qty', 20, 2);
          $table->double('unit_price', 20, 2)->nullable();
          $table->double('unt_sell_price', 20, 2);
          $table->double('selling_price', 20, 2);
          $table->tinyInteger('status');
          $table->rememberToken();
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
        Schema::dropIfExists('invoice_details');
    }
}
