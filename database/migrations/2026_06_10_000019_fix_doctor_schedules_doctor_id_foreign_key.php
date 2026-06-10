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
            try {
                $table->dropForeign(['doctor_id']);
            } catch (\Throwable) {
                // ignore if the old foreign key is missing
            }
        });

        Schema::table('doctor_schedules', function (Blueprint $table) {
            try {
                $table->foreign('doctor_id')->references('id')->on('dokters')->cascadeOnDelete();
            } catch (\Throwable) {
                // ignore if the FK already exists in the correct state
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('doctor_schedules')) {
            return;
        }

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
};
