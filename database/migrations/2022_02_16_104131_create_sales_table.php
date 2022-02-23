<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('vehicle_id')->unsigned();
            $table->bigInteger('enq_id')->unsigned();
            $table->decimal('sale_price', 10, 2)->unsigned();
            $table->string('address_proof', 255)->nullable();
            $table->string('sale_letter', 255)->nullable();


            $table->string('rc_transfer_date')->nullable();
            $table->tinyInteger('rc_transfer_status')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
