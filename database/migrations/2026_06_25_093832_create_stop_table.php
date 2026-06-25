<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stop', function (Blueprint $table) {
            $table->id();
            $table->integer('route_id')->nullable();
            $table->string('route_name',100)->nullable();
            $table->string('stop_name',100)->nullable();
            $table->string('pickup_time',100)->nullable();
            $table->string('drop_time',100)->nullable();
            $table->string('latitude',100)->nullable();
            $table->string('longitude',100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stop');
    }
};