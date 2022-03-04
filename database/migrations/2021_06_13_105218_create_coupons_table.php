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
            'coupons',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('tenant_id');
            $table->string('uuid')->unique();
            $table->string('code');
            $table->string('slug');
            $table->enum('type', ['fixed', 'percent'])->default('percent');
            $table->integer('value')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('description')->nullable();
            $table->dateTime('start_validity')->nullable();
            $table->dateTime('end_validity')->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('coupons');
    }
};
