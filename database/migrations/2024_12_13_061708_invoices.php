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
        schema::create("invoices", function (Blueprint $table) {
            $table->increments('id');
            $table->string("invoice_number");
            $table->string("description");
            $table->decimal("price");
            $table->integer("quantity");
            $table->decimal("subtotal");
            $table->decimal("total");
            $table->date("date");
            $table->string("to");
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
