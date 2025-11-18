<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('vaccines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('animal_id');
            $table->string('name');
            $table->date('date');
            $table->string('veterinarian')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->foreign('animal_id')->references('id')->on('animals')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('vaccines');
    }
};