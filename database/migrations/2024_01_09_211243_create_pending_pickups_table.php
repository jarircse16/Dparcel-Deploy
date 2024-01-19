<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendingPickupsTable extends Migration
{
    public function up()
    {
        Schema::create('pending_pickups', function (Blueprint $table) {
            $table->id();
            $table->string('rider_name');
            $table->string('mobile');
            $table->string('email');
            $table->string('address');
            $table->string('username');
            $table->string('password');
            $table->string('image')->default('default.png');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pending_pickups');
    }
}
