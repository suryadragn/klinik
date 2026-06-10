<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::query()
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $service = new Service();

        return view('admin.services._form', [
            'service' => $service,
            'actionUrl' => route('admin.layanan.store'),
            'httpMethod' => 'POST',
            'submitLabel' => 'Simpan',
            'formTitle' => 'Tambah Layanan / Poli',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $validated['slug'] = $this->makeUniqueSlug($validated['name']);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Service::create($validated);

        return response()->json([
            'message' => 'Layanan / poli berhasil disimpan.',
        ]);
    }

    public function edit(Service $layanan)
    {
        return view('admin.services._form', [
            'service' => $layanan,
            'actionUrl' => route('admin.layanan.update', $layanan->id),
            'httpMethod' => 'PUT',
            'submitLabel' => 'Perbarui',
            'formTitle' => 'Edit Layanan / Poli',
        ]);
    }

    public function update(Request $request, Service $layanan)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $validated['slug'] = $this->makeUniqueSlug($validated['name'], $layanan->id);
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $layanan->update($validated);

        return response()->json([
            'message' => 'Layanan / poli berhasil diperbarui.',
        ]);
    }

    public function destroy(Service $layanan)
    {
        $layanan->delete();

        return response()->json([
            'message' => 'Layanan / poli berhasil dihapus.',
        ]);
    }

    protected function makeUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name) ?: 'layanan';
        $slug = $baseSlug;
        $counter = 1;

        while (
            Service::query()
                ->when($ignoreId, function ($query) use ($ignoreId) {
                    $query->where('id', '!=', $ignoreId);
                })
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug.'-'.$counter++;
        }

        return $slug;
    }
}
