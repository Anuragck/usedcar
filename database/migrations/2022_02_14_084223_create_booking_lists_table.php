<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_lists', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('vehicle_id')->unsigned();
            $table->bigInteger('enq_id')->unsigned();
            $table->string('customer_name',50);

            $table->decimal('booking_amount',10,2)->unsigned();
            $table->decimal('total_payment_recieved',10,2)->unsigned();
            $table->decimal('sale_price',10,2)->unsigned();
            $table->text('remarks')->nullable();
            $table->tinyInteger('sale_status')->default(0);

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
        Schema::dropIfExists('booking_lists');
    }
}
