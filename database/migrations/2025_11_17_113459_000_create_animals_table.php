<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('animals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->enum('species', ['cao', 'gato']);
            $table->enum('age', ['filhote', 'adulto', 'idoso']);
            $table->enum('size', ['pequeno', 'medio', 'grande']);
            $table->enum('sex', ['macho', 'femea']);
            $table->enum('status', ['disponivel', 'em_processo', 'adotado'])->default('disponivel');
            $table->boolean('castrated')->default(false);
            $table->boolean('vaccinated')->default(false);
            $table->boolean('dewormed')->default(false);
            $table->boolean('special_needs')->default(false);
            $table->text('description')->nullable();
            $table->text('special_needs_description')->nullable();
            $table->json('photos')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('animals');
    }
};