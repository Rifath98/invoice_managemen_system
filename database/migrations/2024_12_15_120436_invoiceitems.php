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
        schema::create("invoice_items", function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedInteger("invoice_id");
            $table->string("description");
            $table->decimal("unit_price");
            $table->integer("quantity");
            $table->decimal("subtotal");
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists("invoice_items");
    }
};
