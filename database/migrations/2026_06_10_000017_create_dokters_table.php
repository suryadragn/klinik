<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->id();
            $table->string('kd_dokter', 50)->unique();
            $table->string('nm_dokter', 150);
            $table->string('jk', 1)->nullable();
            $table->string('tmp_lahir', 100)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('gol_drh', 3)->nullable();
            $table->string('agama', 50)->nullable();
            $table->text('almt_tgl')->nullable();
            $table->string('no_telp', 30)->nullable();
            $table->string('stts_nikah', 30)->nullable();
            $table->string('kd_sps', 20)->nullable();
            $table->string('alumni', 150)->nullable();
            $table->string('no_ijn_praktek', 100)->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokters');
    }
};

