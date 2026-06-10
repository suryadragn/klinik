<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment('Stay focused, stay consistent.');
})->purpose('Display an inspiring quote');

