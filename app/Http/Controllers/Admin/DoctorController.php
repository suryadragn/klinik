<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Dokter::query()
            ->orderBy('nm_dokter')
            ->get();

        return view('admin.dokters.index', compact('doctors'));
    }

    public function create()
    {
        $doctor = new Dokter();

        if (request()->ajax()) {
            return view('admin.dokters._form', compact('doctor'));
        }

        return view('admin.dokters.create', compact('doctor'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kd_dokter' => ['required', 'string', 'max:50', 'unique:dokters,kd_dokter'],
            'nm_dokter' => ['required', 'string', 'max:150'],
            'jk' => ['nullable', 'string', 'max:1'],
            'tmp_lahir' => ['nullable', 'string', 'max:100'],
            'tgl_lahir' => ['nullable', 'date'],
            'gol_drh' => ['nullable', 'string', 'max:3'],
            'agama' => ['nullable', 'string', 'max:50'],
            'almt_tgl' => ['nullable', 'string'],
            'no_telp' => ['nullable', 'string', 'max:30'],
            'stts_nikah' => ['nullable', 'string', 'max:30'],
            'kd_sps' => ['nullable', 'string', 'max:20'],
            'alumni' => ['nullable', 'string', 'max:150'],
            'no_ijn_praktek' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable'],
        ]);

        $data['status'] = $request->boolean('status');

        $doctor = Dokter::create($data);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Data dokter berhasil ditambahkan.',
                'data' => $doctor,
            ]);
        }

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $doctor = Dokter::findOrFail($id);

        if (request()->ajax()) {
            return view('admin.dokters._form', compact('doctor'));
        }

        return view('admin.dokters.edit', compact('doctor'));
    }

    public function update(Request $request, string $id)
    {
        $doctor = Dokter::findOrFail($id);

        $data = $request->validate([
            'kd_dokter' => ['required', 'string', 'max:50', 'unique:dokters,kd_dokter,' . $doctor->id],
            'nm_dokter' => ['required', 'string', 'max:150'],
            'jk' => ['nullable', 'string', 'max:1'],
            'tmp_lahir' => ['nullable', 'string', 'max:100'],
            'tgl_lahir' => ['nullable', 'date'],
            'gol_drh' => ['nullable', 'string', 'max:3'],
            'agama' => ['nullable', 'string', 'max:50'],
            'almt_tgl' => ['nullable', 'string'],
            'no_telp' => ['nullable', 'string', 'max:30'],
            'stts_nikah' => ['nullable', 'string', 'max:30'],
            'kd_sps' => ['nullable', 'string', 'max:20'],
            'alumni' => ['nullable', 'string', 'max:150'],
            'no_ijn_praktek' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable'],
        ]);

        $data['status'] = $request->boolean('status');

        $doctor->update($data);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Data dokter berhasil diperbarui.',
                'data' => $doctor->fresh(),
            ]);
        }

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $doctor = Dokter::findOrFail($id);
        $doctor->delete();

        if (request()->ajax()) {
            return response()->json([
                'message' => 'Data dokter berhasil dihapus.',
            ]);
        }

        return redirect()->route('admin.dokter.index')->with('success', 'Data dokter berhasil dihapus.');
    }
}
