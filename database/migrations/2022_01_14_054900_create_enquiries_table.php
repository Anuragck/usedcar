<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->string('name',50);
            $table->string('email',50)->nullable();
            $table->string('mobile',15);
            $table->string('enq_vehicle_reg_no',50);
            $table->string('enq_brand',50);
            $table->string('enq_model',50);
            $table->string('source_of_lead',20)->nullable();
            $table->text('referee_details')->nullable();
            $table->tinyInteger('priority_status')->default(0);
            $table->tinyInteger('lead_status')->default(0);
            $table->text('conversion_remarks')->nullable();


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
        Schema::dropIfExists('enquiries');
    }
}
