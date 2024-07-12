<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('borrowing_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained();
            $table->string('user_name');
            $table->integer('quantity');
            $table->date('borrowed_at');
            $table->date('returned_at')->nullable();
            $table->timestamps();

          //  $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
   });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_records');
    }
};
