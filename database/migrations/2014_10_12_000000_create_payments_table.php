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
          $table->increments('id');
          $table->integer('invoice_id')->unsigned()->comment('PK on invoices table');
          $table->integer('customer_id')->unsigned()->comment('PK on customers table');
          $table->string('paid_status',200);
          $table->double('paid_amount', 20, 2);
          $table->double('due_amount', 20, 2)->nullable();
          $table->double('total_amount', 20, 2);
          $table->double('discount_amount', 20, 2);
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
        Schema::dropIfExists('payments');
    }
}
