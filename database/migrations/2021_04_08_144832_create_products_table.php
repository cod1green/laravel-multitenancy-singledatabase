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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->uuid('uuid');
            $table->string('name');
            $table->string('slug');
            $table->integer('quantity')->unsigned()->default(1);
            $table->integer('min_quantity')->unsigned()->default(0);
            $table->double('cost_price', 10, 2)->nullable();
            $table->double('price', 10, 2);
            $table->double('lucre', 10, 2)->nullable();
            $table->string('image')->nullable();
            $table->string('details')->nullable();
            $table->string('description')->nullable();
            $table->boolean('featured')->default(false);
            $table->timestamps();

            $table->unique(['tenant_id', 'slug']);
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
        Schema::dropIfExists('products');
    }
};
