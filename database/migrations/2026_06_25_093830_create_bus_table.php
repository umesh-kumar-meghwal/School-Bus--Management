<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bus', function (Blueprint $table) {
            $table->id();
            $table->string('bus_number',50)->nullable();
            $table->string('bus_name',50)->nullable();
            $table->string('driver_name',50)->nullable();
            $table->string('driver_phone',15)->nullable();
            $table->string('route_name',100)->nullable();
            $table->integer('total_seats')->nullable();
            $table->integer('available_seats')->nullable();
            $table->enum('status',['active','inactive','maintenace'])->nullable();
            $table->string('latitude',100)->nullable();
            $table->string('longitude',100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bus');
    }
};