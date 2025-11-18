<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('adoption_stories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('adopter_name');
            $table->string('animal_name');
            $table->text('story');
            $table->string('photo_url')->nullable();
            $table->boolean('approved')->default(false);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('adoption_stories');
    }
};