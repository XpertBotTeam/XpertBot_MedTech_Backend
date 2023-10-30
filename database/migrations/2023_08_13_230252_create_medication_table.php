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
        Schema::create('medications', function (Blueprint $table) {
            $table->id('id');
            $table->string('dose');
            $table->string('frequency');
            $table->dateTime('reminder-time');
            $table->text('prescription');
            $table->foreignId('user-id')->constraint()->onDelete('cascade');;
            $table->foreignId('patient-id')->constraint()->onDelete('cascade');;
            $table->foreignId('medicine-id')->constraint()->onDelete('cascade');;
            $table->timestamps();

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
