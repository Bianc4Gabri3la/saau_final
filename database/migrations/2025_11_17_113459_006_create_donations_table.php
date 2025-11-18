<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('donations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('donor_name');
            $table->string('donor_email')->nullable();
            $table->decimal('amount', 10, 2);
            $table->enum('type', ['dinheiro', 'racao', 'medicamento', 'outro']);
            $table->text('description')->nullable();
            $table->date('date');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('donations');
    }
};