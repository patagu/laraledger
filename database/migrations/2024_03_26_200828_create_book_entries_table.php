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
        Schema::create('book_entries', function (Blueprint $table) {
            $table->uuid('id');
            $table->dateTime('date');
            $table->decimal('debit', 15, 2);
            $table->decimal('credit', 15, 2);
            $table->foreignId('account_id');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_entries');
    }
};
