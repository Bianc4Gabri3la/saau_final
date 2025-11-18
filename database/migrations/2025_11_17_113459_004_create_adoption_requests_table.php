<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('adoption_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('animal_id');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('city_state');
            $table->string('housing_type');
            $table->text('had_pets')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
            $table->timestamps();
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('adoption_requests');
    }
};