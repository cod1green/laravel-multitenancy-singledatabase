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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained();
            $table->uuid('uuid')->unique();
            $table->string('domain')->nullable();
            $table->string('subdomain')->nullable();
            $table->string('document');
            $table->string('company');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email');
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
