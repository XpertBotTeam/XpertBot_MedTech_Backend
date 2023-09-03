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
        Schema::create('medication', function (Blueprint $table) {
            $table->id('id');
            $table->string('dose');
            $table->string('frequency');
            $table->time('time');
            $table->text('prescription');
            $table->timestamps();
            $table->foreignId('user-id')->constraint()->onDelete('cascade');;
            $table->foreignId('patient-id')->constraint()->onDelete('cascade');;
            $table->foreignId('medicine-id')->constraint()->onDelete('cascade');;

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medication');
    }
};
