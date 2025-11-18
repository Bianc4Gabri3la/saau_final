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
        Schema::table('animals', function (Blueprint $table) {
            $table->string('breed')->nullable()->after('species');
            $table->string('gender')->nullable()->after('age');
            $table->string('color')->nullable()->after('size');
            $table->string('health_status')->nullable()->after('special_needs_description');
            $table->text('health_notes')->nullable()->after('health_status');
            $table->string('photo')->nullable()->after('photos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->dropColumn(['breed', 'gender', 'color', 'health_status', 'health_notes', 'photo']);
        });
    }
};
