<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');
            $table->foreignId('pick_rider')->nullable()->constrained('riders');
            $table->foreignId('drop_rider')->nullable()->constrained('riders');
            $table->string('item_name');
            $table->integer('qty');
            $table->integer('item_price');
            $table->integer('delivery_charge');
            $table->integer('total_price');
            $table->string('delivery_type')->default('cash on delivery');
            $table->string('delivery_des')->default('inside city');
            $table->date('delivery_time');
            $table->string('recipient_name');
            $table->string('recipient_number');
            $table->text('recipient_address');
            $table->string('status')->default('Pending');
            $table->string('pick_status')->nullable();
            $table->string('drop_status')->nullable();
            $table->boolean('is_pick')->default(0);
            $table->boolean('is_drop')->default(0);
            $table->string('location')->nullable();
            $table->string('status_description')->nullable();
            $table->date('date_created')->default(now());
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
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
        Schema::dropIfExists('deliveries');
    }
}
