<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('raffles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->text('description');
            $table->text('prize');
            $table->decimal('ticket_price', 10, 2);
            $table->date('draw_date');
            $table->enum('status', ['ativa', 'pausada', 'encerrada'])->default('ativa');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('raffles');
    }
};