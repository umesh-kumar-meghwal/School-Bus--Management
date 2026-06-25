<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('address',100)->nullable();
            $table->string('contact',15)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};