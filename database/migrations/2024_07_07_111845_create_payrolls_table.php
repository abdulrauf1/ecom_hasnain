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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('emp_id');
            $table->string('pid');
            $table->string('month');
            $table->double('salary');
            $table->double('relocation');
            $table->double('bonus');
            $table->double('transportationSubsidy');
            $table->double('nonSalaryBenefit');
            $table->double('prepaid');
            $table->double('prepaidMedicine');
            $table->double('housingInterest');
            $table->double('voluntryPension');
            $table->double('afcAccounts');
            $table->timestamps();

            $table->index('emp_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
