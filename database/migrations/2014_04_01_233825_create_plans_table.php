<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'plans',
            function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->unique();
                $table->string('name')->unique();
                $table->string('url')->unique();
                $table->double('price', 10, 2);
                $table->string('description')->nullable();
                $table->string('stripe_id')->unique()->nullable();
                $table->boolean('recommended')->default(false);
                $table->enum('period', ['year', 'semester', 'trimester', 'month'])->default('month');
                $table->enum('access', ['public', 'private'])->default('public');
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
        Schema::dropIfExists('plans');
    }
};
