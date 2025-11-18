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
        Schema::table('vaccines', function (Blueprint $table) {
            // Só cria se ainda não existir, pra evitar erro se um dia você rodar de novo
            if (!Schema::hasColumn('vaccines', 'vaccine_type')) {
                $table->string('vaccine_type')->after('animal_id');
            }

            if (!Schema::hasColumn('vaccines', 'application_date')) {
                $table->date('application_date')->after('vaccine_type');
            }

            if (!Schema::hasColumn('vaccines', 'next_dose_date')) {
                $table->date('next_dose_date')->nullable()->after('application_date');
            }

            if (!Schema::hasColumn('vaccines', 'notes')) {
                $table->text('notes')->nullable()->after('next_dose_date');
            }

            if (!Schema::hasColumn('vaccines', 'created_by')) {
                $table->unsignedBigInteger('created_by')->nullable()->after('notes');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vaccines', function (Blueprint $table) {
            // Se um dia quiser desfazer
            if (Schema::hasColumn('vaccines', 'vaccine_type')) {
                $table->dropColumn('vaccine_type');
            }
            if (Schema::hasColumn('vaccines', 'application_date')) {
                $table->dropColumn('application_date');
            }
            if (Schema::hasColumn('vaccines', 'next_dose_date')) {
                $table->dropColumn('next_dose_date');
            }
            if (Schema::hasColumn('vaccines', 'notes')) {
                $table->dropColumn('notes');
            }
            if (Schema::hasColumn('vaccines', 'created_by')) {
                $table->dropColumn('created_by');
            }
        });
    }
};
