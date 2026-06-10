<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('doctor_schedules')) {
            Schema::table('doctor_schedules', function (Blueprint $table) {
                try {
                    $table->dropForeign(['doctor_id']);
                } catch (\Throwable) {
                    // ignore if foreign key does not exist yet
                }
            });

            Schema::table('doctor_schedules', function (Blueprint $table) {
                try {
                    $table->foreign('doctor_id')->references('id')->on('dokters')->cascadeOnDelete();
                } catch (\Throwable) {
                    // ignore if column exists with different state
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('doctor_schedules')) {
            Schema::table('doctor_schedules', function (Blueprint $table) {
                try {
                    $table->dropForeign(['doctor_id']);
                } catch (\Throwable) {
                    // ignore
                }
            });

            Schema::table('doctor_schedules', function (Blueprint $table) {
                try {
                    $table->foreign('doctor_id')->references('id')->on('doctors')->cascadeOnDelete();
                } catch (\Throwable) {
                    // ignore
                }
            });
        }
    }
};

