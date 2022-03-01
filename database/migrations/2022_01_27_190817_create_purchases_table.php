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
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->bigInteger('model_id')->unsigned();
            $table->string('color',20)->nullable();
            $table->string('year_of_reg',4)->nullable();
            $table->string('reg_no',20)->nullable();
            $table->string('fuel',20)->nullable();
            $table->string('kms_driven',255)->nullable();
            $table->string('no_of_owners',4)->nullable();
            $table->string('cc',20)->nullable();
            $table->string('rto',50)->nullable();
            $table->string('transmission_type',20)->nullable();
            $table->string('gear_box',20)->nullable();
            $table->string('milage_per_km',20)->nullable();
            $table->string('no_of_seats',10)->nullable();
            $table->string('drive_type',20)->nullable();
            $table->string('front_brake')->nullable();
            $table->string('back_brake')->nullable();
            $table->string('body_type')->nullable();

            $table->tinyInteger('power_steering')->nullable();
            $table->tinyInteger('abs')->nullable();
            $table->tinyInteger('driver_air_bag')->nullable();
            $table->tinyInteger('passenger_air_bag')->nullable();
            $table->tinyInteger('auto_climate_control')->nullable();
            $table->tinyInteger('alloy_wheel')->nullable();
            $table->tinyInteger('ac')->nullable();


            $table->decimal('purchase_price',10,2)->unsigned();
            $table->text('description')->nullable();
            $table->decimal('selling_price',10,2)->unsigned()->nullable();

            $table->tinyInteger('add_to_website')->nullable();
            $table->tinyInteger('add_to_homepage')->nullable();
            $table->tinyInteger('sale_status')->default(0);

            $table->string('seller_name',50);
            $table->string('phone',20);
            $table->string('email',50)->nullable();
            $table->text('address',50)->nullable();

            $table->string('address_proof',255)->nullable();
            $table->string('reg_certificate',255)->nullable();
            $table->string('insurance',255)->nullable();





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
        Schema::dropIfExists('purchases');
    }
}
