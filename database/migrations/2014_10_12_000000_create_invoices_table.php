<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('invoice_no')->unsigned()->comment('PK on invoices table');
          $table->string('name',200)->nullable();
          $table->date('date');
          $table->tinyInteger('status')->default(0)->comment('0 = Pending, 1 = Approved');
          $table->text('description')->nullable();
          $table->integer('approved_by')->nullable();
          $table->integer('created_by')->nullable();
          $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
