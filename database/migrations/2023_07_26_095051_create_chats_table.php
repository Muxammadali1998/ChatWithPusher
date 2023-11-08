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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('from');
            $table->bigInteger('to');
            $table->bigInteger('count')->default(0);
            $table->bigInteger('reader')->nullable();
            $table->timestamps();
            $table->unique(['from', 'to']);
            $table->unique(['to', 'from']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
