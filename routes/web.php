<?php

use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\DoctorController;
use App\Http\Controllers\Site\GalleryController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\NewsController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Site\ServiceController;
use App\Http\Controllers\Admin\ClinicProfileController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\DoctorScheduleController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\NewsCategoryController;
use App\Http\Controllers\Admin\NewsPostController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SocialLinkController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
});

Route::get('/', [HomeController::class, 'index'])->name('public.home');
Route::get('/profil', [ProfileController::class, 'index'])->name('public.profile');
Route::get('/layanan', [ServiceController::class, 'index'])->name('public.services.index');
Route::get('/layanan/{slug}', [ServiceController::class, 'show'])->name('public.services.show');
Route::get('/dokter', [DoctorController::class, 'index'])->name('public.doctors.index');
Route::get('/dokter/{slug}', [DoctorController::class, 'show'])->name('public.doctors.show');
Route::get('/berita', [NewsController::class, 'index'])->name('public.news.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('public.news.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('public.gallery');
Route::get('/kontak', [ContactController::class, 'index'])->name('public.contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('public.contact.store');

Route::prefix('admin')->name('admin.')->middleware('admin.access')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('admin.permission:dashboard.access');

    Route::get('/profil-klinik', [ClinicProfileController::class, 'index'])
        ->name('clinic-profile.index')
        ->middleware('admin.permission:clinic-profile.manage');
    Route::resource('/layanan', AdminServiceController::class)
        ->except(['show'])
        ->middleware('admin.permission:services.manage');
    Route::resource('/dokter', AdminDoctorController::class)
        ->except(['show'])
        ->middleware('admin.permission:doctors.manage');
    Route::resource('/jadwal-dokter', DoctorScheduleController::class)
        ->except(['show'])
        ->middleware('admin.permission:doctor-schedules.manage');
    Route::resource('/kategori-berita', NewsCategoryController::class)
        ->except(['show'])
        ->middleware('admin.permission:news-categories.manage');
    Route::resource('/berita', NewsPostController::class)
        ->except(['show'])
        ->middleware('admin.permission:news-posts.manage');
    Route::resource('/galeri', AdminGalleryController::class)
        ->except(['show'])
        ->middleware('admin.permission:galleries.manage');
    Route::resource('/pesan-kontak', ContactMessageController::class)
        ->only(['index', 'show', 'destroy'])
        ->middleware('admin.permission:contact-messages.manage');
    Route::resource('/social-link', SocialLinkController::class)
        ->except(['show'])
        ->middleware('admin.permission:social-links.manage');
    Route::get('/setting', [SettingController::class, 'index'])
        ->name('setting.index')
        ->middleware('admin.permission:settings.manage');
    Route::put('/setting', [SettingController::class, 'update'])
        ->name('setting.update')
        ->middleware('admin.permission:settings.manage');
});
