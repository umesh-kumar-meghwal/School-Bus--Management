<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('driver', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('license_number',50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('driver');
    }
};