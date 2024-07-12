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
        Schema::create('withholdings_taxes', function (Blueprint $table) {
            $table->id();
            $table->integer('UVTRangeFrom');
            $table->integer('UVTRangeTo');
            $table->double('marginalRate');
            $table->integer('anyLess');
            $table->double('by');
            $table->integer('further');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withholdings_taxes');
    }
};
