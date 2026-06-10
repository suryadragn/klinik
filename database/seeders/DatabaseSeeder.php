<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\ClinicProfile;
use App\Models\Role;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'Dashboard Access', 'slug' => 'dashboard.access', 'module' => 'dashboard'],
            ['name' => 'Manage Clinic Profile', 'slug' => 'clinic-profile.manage', 'module' => 'clinic-profile'],
            ['name' => 'Manage Services', 'slug' => 'services.manage', 'module' => 'services'],
            ['name' => 'Manage Doctors', 'slug' => 'doctors.manage', 'module' => 'doctors'],
            ['name' => 'Manage Doctor Schedules', 'slug' => 'doctor-schedules.manage', 'module' => 'doctor-schedules'],
            ['name' => 'Manage News Categories', 'slug' => 'news-categories.manage', 'module' => 'news-categories'],
            ['name' => 'Manage News Posts', 'slug' => 'news-posts.manage', 'module' => 'news-posts'],
            ['name' => 'Manage Galleries', 'slug' => 'galleries.manage', 'module' => 'galleries'],
            ['name' => 'Manage Contact Messages', 'slug' => 'contact-messages.manage', 'module' => 'contact-messages'],
            ['name' => 'Manage Social Links', 'slug' => 'social-links.manage', 'module' => 'social-links'],
            ['name' => 'Manage Settings', 'slug' => 'settings.manage', 'module' => 'settings'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['slug' => $permission['slug']], $permission + ['description' => null, 'is_active' => true]);
        }

        $superadmin = Role::firstOrCreate(
            ['slug' => 'superadmin'],
            ['name' => 'Super Admin', 'description' => 'Full access to all modules', 'is_active' => true]
        );

        $admin = Role::firstOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Admin', 'description' => 'Standard admin access', 'is_active' => true]
        );

        $superadmin->permissions()->sync(Permission::pluck('id')->all());
        $admin->permissions()->sync(
            Permission::where('slug', '!=', 'settings.manage')->pluck('id')->all()
        );

        User::updateOrCreate(
            ['username' => 'admingriy4'],
            [
                'name' => 'Superadmin Klinik Griya Husada 1',
                'email' => 'admingriy4@localhost.test',
                'password' => Hash::make('griya4husada1'),
                'role' => 'superadmin',
                'is_active' => true,
            ]
        );

        ClinicProfile::updateOrCreate(
            ['slug' => Str::slug((string) env('APP_CLINIC_NAME', 'Klinik Griya Husada 1'))],
            [
                'name' => env('APP_CLINIC_NAME', 'Klinik Griya Husada 1'),
                'short_name' => env('APP_CLINIC_SHORT_NAME', 'KGH 1'),
                'description' => env('APP_CLINIC_DESCRIPTION', ''),
                'vision' => null,
                'mission' => null,
                'history' => null,
                'logo_path' => null,
                'cover_path' => null,
                'is_active' => true,
            ]
        );

        $settings = [
            'clinic_name' => env('APP_CLINIC_NAME', 'Klinik Griya Husada 1'),
            'clinic_short_name' => env('APP_CLINIC_SHORT_NAME', 'KGH 1'),
            'clinic_tagline' => env('APP_CLINIC_TAGLINE', ''),
            'clinic_description' => env('APP_CLINIC_DESCRIPTION', ''),
            'clinic_address' => env('APP_CLINIC_ADDRESS', ''),
            'clinic_phone' => env('APP_CLINIC_PHONE', ''),
            'clinic_whatsapp' => env('APP_CLINIC_WHATSAPP', ''),
            'clinic_email' => env('APP_CLINIC_EMAIL', ''),
            'clinic_maps_url' => env('APP_CLINIC_MAPS_URL', ''),
            'clinic_instagram' => env('APP_CLINIC_INSTAGRAM', ''),
            'clinic_opening_hours' => env('APP_CLINIC_OPENING_HOURS', ''),
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'type' => 'text',
                    'group_name' => 'clinic',
                    'is_active' => true,
                ]
            );
        }

        $this->call(DokterSeeder::class);
    }
}
