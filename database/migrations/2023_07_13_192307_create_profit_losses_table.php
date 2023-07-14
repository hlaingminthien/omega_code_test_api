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
        Schema::create('profit_losses', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->float('revenue');
            $table->float('expenses');
            $table->string('customer_name');
            $table->string('contact_person');
            $table->string('deal_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profit_losses');
    }
};
