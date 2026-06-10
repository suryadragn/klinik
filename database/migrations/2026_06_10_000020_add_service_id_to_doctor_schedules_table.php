<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('doctor_schedules')) {
            return;
        }

        Schema::table('doctor_schedules', function (Blueprint $table) {
            if (! Schema::hasColumn('doctor_schedules', 'service_id')) {
                $table->foreignId('service_id')
                    ->nullable()
                    ->after('doctor_id')
                    ->constrained('services')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('doctor_schedules')) {
            return;
        }

        Schema::table('doctor_schedules', function (Blueprint $table) {
            if (Schema::hasColumn('doctor_schedules', 'service_id')) {
                try {
                    $table->dropForeign(['service_id']);
                } catch (\Throwable) {
                    // ignore
                }

                $table->dropColumn('service_id');
            }
        });
    }
};
