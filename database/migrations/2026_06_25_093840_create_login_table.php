<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('login', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('password')->nullable();
            $table->string('usertype')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('login');
    }
};