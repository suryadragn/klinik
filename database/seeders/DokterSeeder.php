<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        $sourcePath = database_path('seeders/data/dokters.tsv');

        if (! File::exists($sourcePath)) {
            $this->command?->warn('dokters.tsv tidak ditemukan di database/seeders/data/dokters.tsv. Seeder dilewati.');
            return;
        }

        $rows = $this->parseTsv($sourcePath);

        if (empty($rows)) {
            $this->command?->warn('Tidak ada data dokter yang bisa diseed.');
            return;
        }

        DB::table('dokters')->upsert(
            $rows,
            ['kd_dokter'],
            [
                'nm_dokter',
                'jk',
                'tmp_lahir',
                'tgl_lahir',
                'gol_drh',
                'agama',
                'almt_tgl',
                'no_telp',
                'stts_nikah',
                'kd_sps',
                'alumni',
                'no_ijn_praktek',
                'status',
                'updated_at',
            ]
        );
    }

    private function parseTsv(string $path): array
    {
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($lines === false || count($lines) < 2) {
            return [];
        }

        $headers = array_map('trim', explode("\t", array_shift($lines)));
        $records = [];

        foreach ($lines as $line) {
            $columns = explode("\t", $line);
            $row = [];

            foreach ($headers as $index => $header) {
                $row[$header] = $columns[$index] ?? null;
            }

            $records[] = $this->normalizeRow($row);
        }

        return $records;
    }

    private function normalizeRow(array $row): array
    {
        $kdDokter = trim((string) ($row['kd_dokter'] ?? ''));
        $tglLahir = $this->normalizeDate($row['tgl_lahir'] ?? null);
        $status = $this->normalizeStatus($row['status'] ?? null);

        return [
            'kd_dokter' => $kdDokter,
            'nm_dokter' => $this->normalizeText($row['nm_dokter'] ?? null, true),
            'jk' => $this->normalizeText($row['jk'] ?? null),
            'tmp_lahir' => $this->normalizeText($row['tmp_lahir'] ?? null),
            'tgl_lahir' => $tglLahir,
            'gol_drh' => $this->normalizeText($row['gol_drh'] ?? null),
            'agama' => $this->normalizeText($row['agama'] ?? null),
            'almt_tgl' => $this->normalizeText($row['almt_tgl'] ?? null),
            'no_telp' => $this->normalizePhone($row['no_telp'] ?? null),
            'stts_nikah' => $this->normalizeText($row['stts_nikah'] ?? null),
            'kd_sps' => $this->normalizeText($row['kd_sps'] ?? null),
            'alumni' => $this->normalizeText($row['alumni'] ?? null),
            'no_ijn_praktek' => $this->normalizeText($row['no_ijn_praktek'] ?? null),
            'status' => $status,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function normalizeText(mixed $value, bool $required = false): ?string
    {
        $value = is_string($value) ? trim($value) : $value;

        if ($value === '' || $value === '-' || $value === null) {
            return $required ? '' : null;
        }

        return (string) $value;
    }

    private function normalizePhone(mixed $value): ?string
    {
        $value = is_string($value) ? trim($value) : $value;

        if ($value === '' || $value === '-' || $value === null) {
            return null;
        }

        return (string) $value;
    }

    private function normalizeStatus(mixed $value): bool
    {
        return (int) trim((string) $value) === 1;
    }

    private function normalizeDate(mixed $value): ?string
    {
        $value = is_string($value) ? trim($value) : $value;

        if ($value === '' || $value === '-' || $value === null) {
            return null;
        }

        try {
            return Carbon::parse((string) $value)->format('Y-m-d');
        } catch (\Throwable) {
            return null;
        }
    }
}
