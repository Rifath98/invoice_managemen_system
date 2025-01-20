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
        schema::create("customers", function (Blueprint $table) {
            $table->increments("id");
            $table->string("customerName");
            $table->string("customerEmail");
            $table->string("customerPhone");
            $table->string("customerAddress");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
