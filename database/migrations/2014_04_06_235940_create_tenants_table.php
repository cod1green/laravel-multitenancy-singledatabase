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
            'tenants',
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('plan_id')->constrained();
            $table->uuid('uuid')->unique();
            $table->string('document')->unique();
            $table->string('company')->unique();
            $table->string('name')->unique();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->string('url')->unique();
            $table->string('logo')->nullable();
            $table->text('about')->nullable();

            // Status tenant (se inativar 'N' ele perde o acesso ao sistema)
            $table->enum('active', ['Y', 'N'])->default('Y');

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
        Schema::dropIfExists('tenants');
    }
};
