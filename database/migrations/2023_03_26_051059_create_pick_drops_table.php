<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickDropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pick_drops', function (Blueprint $table) {
            $table->id();
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
            $table->string('pick_name');
            $table->string('product_image')->nullable();
            $table->text('description')->nullable();
            $table->string('pick_number');
            $table->text('pick_address');
            $table->string('drop_name');
            $table->string('drop_number');
            $table->text('drop_address');
            $table->string('status')->default('Pending');
            $table->string('pick_status')->nullable();
            $table->string('drop_status')->nullable();
            $table->boolean('is_pick')->default(0);
            $table->boolean('is_drop')->default(0);
            $table->string('location')->nullable();
            $table->date('date_created')->default(now());
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
        Schema::dropIfExists('pick_drops');
    }
}
