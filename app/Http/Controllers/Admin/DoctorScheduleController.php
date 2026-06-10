<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\DoctorSchedule;
use App\Models\Service;
use Illuminate\Http\Request;

class DoctorScheduleController extends Controller
{
    public function index()
    {
        $schedules = DoctorSchedule::query()
            ->with(['doctor', 'service'])
            ->orderByRaw("FIELD(day_name, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')")
            ->orderBy('start_time')
            ->get();

        return view('admin.doctor-schedules.index', compact('schedules'));
    }

    public function create()
    {
        $dokters = Dokter::query()
            ->orderBy('nm_dokter')
            ->get();
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $schedule = new DoctorSchedule();

        if (request()->ajax()) {
            return view('admin.doctor-schedules._form', compact('dokters', 'services', 'schedule'));
        }

        return view('admin.doctor-schedules.create', compact('dokters', 'services', 'schedule'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'doctor_id' => ['required', 'exists:dokters,id'],
            'service_id' => ['required', 'exists:services,id'],
            'day_name' => ['required', 'string', 'max:30'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'room_name' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $schedule = DoctorSchedule::create($data);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Jadwal dokter berhasil ditambahkan.',
                'data' => $schedule->load('doctor'),
            ]);
        }

        return redirect()->route('admin.jadwal-dokter.index')->with('success', 'Jadwal dokter berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $schedule = DoctorSchedule::with(['doctor', 'service'])->findOrFail($id);
        $dokters = Dokter::query()
            ->orderBy('nm_dokter')
            ->get();
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        if (request()->ajax()) {
            return view('admin.doctor-schedules._form', compact('schedule', 'dokters', 'services'));
        }

        return view('admin.doctor-schedules.edit', compact('schedule', 'dokters', 'services'));
    }

    public function update(Request $request, string $id)
    {
        $schedule = DoctorSchedule::findOrFail($id);

        $data = $request->validate([
            'doctor_id' => ['required', 'exists:dokters,id'],
            'service_id' => ['required', 'exists:services,id'],
            'day_name' => ['required', 'string', 'max:30'],
            'start_time' => ['nullable', 'date_format:H:i'],
            'end_time' => ['nullable', 'date_format:H:i'],
            'room_name' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
            'is_active' => ['nullable'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        $schedule->update($data);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Jadwal dokter berhasil diperbarui.',
                'data' => $schedule->fresh()->load('doctor'),
            ]);
        }

        return redirect()->route('admin.jadwal-dokter.index')->with('success', 'Jadwal dokter berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $schedule = DoctorSchedule::findOrFail($id);
        $schedule->delete();

        if (request()->ajax()) {
            return response()->json([
                'message' => 'Jadwal dokter berhasil dihapus.',
            ]);
        }

        return redirect()->route('admin.jadwal-dokter.index')->with('success', 'Jadwal dokter berhasil dihapus.');
    }
}
