<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     */
    public function up()
{
    Schema::create('sessions', function (Blueprint $table) {
        $table->id();
        $table->string('description');
        $table->string('class');
        $table->string('time');
        $table->string('endtime');
        $table->string('date');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
