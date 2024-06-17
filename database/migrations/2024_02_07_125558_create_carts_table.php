<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('item_id');
            $table->string('item_name');
            $table->string('item_model');
            $table->string('user_name');
            $table->string('user_email');
            $table->integer('quantity');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }
    

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
