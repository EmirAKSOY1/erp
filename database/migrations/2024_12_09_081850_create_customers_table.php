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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');           
            $table->string('last_name');            
            $table->string('tc_number')->unique();   
            $table->text('address');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->string('tax_office');
            $table->string('country');
            $table->enum('customer_type', ['individual', 'company'])->default('individual');
            $table->string('contact_person')->nullable();
            $table->string('vkn')->nullable();
            $table->text('notes')->nullable();
            $table->text('iban')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active'); 
            $table->timestamps();
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
