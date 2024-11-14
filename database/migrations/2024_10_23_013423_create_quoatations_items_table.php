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
        Schema::create('quoatations_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quotation_id');
            $table->unsignedBigInteger('material_id');
            $table->string('material');
            $table->string('description');
            $table->string('unit');
            
            $table->double('qty');
            $table->double('rate');
            
            $table->timestamps();
            $table->index('quotation_id');
            $table->index('material_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quoatations_items');
    }
};
