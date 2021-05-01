<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name',200)->nullable();
          $table->string('email')->unique()->nullable();
          $table->string('mobile_no', 100)->nullable();
          $table->text('address')->nullable();
          $table->string('status');
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
        Schema::dropIfExists('suppliers');
    }
}
