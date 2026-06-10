<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'username')) {
                $table->string('username')->nullable()->unique()->after('id');
            }
        });

        $users = DB::table('users')->select('id', 'email', 'username')->get();

        foreach ($users as $user) {
            if (empty($user->username)) {
                $baseUsername = $user->email ? explode('@', $user->email)[0] : 'user' . $user->id;
                $candidate = $baseUsername;
                $suffix = 1;

                while (DB::table('users')->where('username', $candidate)->where('id', '!=', $user->id)->exists()) {
                    $candidate = $baseUsername . $suffix;
                    $suffix++;
                }

                DB::table('users')->where('id', $user->id)->update([
                    'username' => $candidate,
                ]);
            }
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'username')) {
                $table->dropUnique(['username']);
                $table->dropColumn('username');
            }
        });
    }
};

