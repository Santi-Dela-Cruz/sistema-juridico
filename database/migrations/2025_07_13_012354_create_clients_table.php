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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->enum('identification_type', ['Cédula', 'RUC', 'Pasaporte']);
            $table->enum('person_type', ['jurídica', 'natural']);
            $table->string('identification_number')->unique();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamp('registered_at')->useCurrent();

            // Para personas naturales
            $table->string('marital_status')->nullable();

            // Para personas jurídicas
            $table->string('legal_representative')->nullable();
            $table->string('fiscal_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
