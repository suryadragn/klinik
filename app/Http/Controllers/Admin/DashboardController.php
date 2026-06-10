<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\DoctorSchedule;
use App\Models\Service;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $serviceCount = Service::where('is_active', true)->count();
        $doctorCount = Dokter::where('status', true)->count();
        $scheduleCount = DoctorSchedule::where('is_active', true)->count();

        $schedules = DoctorSchedule::query()
            ->with(['doctor', 'service'])
            ->where('is_active', true)
            ->orderByRaw("FIELD(day_name, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('start_time')
            ->get()
            ->groupBy('day_name');

        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('admin.dashboard.index', compact(
            'serviceCount',
            'doctorCount',
            'scheduleCount',
            'schedules',
            'days'
        ));
    }
}
