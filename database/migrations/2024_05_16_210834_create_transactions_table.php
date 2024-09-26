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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_id');
            $table->string('sender_name');
            $table->float('amount');
            $table->unsignedBigInteger('recipient_id');
            $table->string('recipient_name');
            $table->timestamps();

          //  $table->foreign('sender_id')->references('account_id')->on('accounts')->onDelete('cascade');
         //   $table->foreign('recipient_id')->references('account_id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
