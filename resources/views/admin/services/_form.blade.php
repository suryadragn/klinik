<form id="serviceForm" action="{{ $actionUrl }}" method="POST">
    @csrf
    @if (in_array($httpMethod, ['PUT', 'PATCH']))
        @method($httpMethod)
    @endif

    <div class="form-row">
        <div class="form-group col-md-8">
            <label class="font-weight-semibold">Nama Layanan / Poli</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $service->name) }}" placeholder="Contoh: Poli Umum" required>
        </div>
        <div class="form-group col-md-4">
            <label class="font-weight-semibold">Urutan Tampil</label>
            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $service->sort_order ?? 0) }}" min="0">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="font-weight-semibold">Icon FontAwesome</label>
            <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon) }}" placeholder="fas fa-stethoscope">
            <small class="text-muted">Gunakan class icon FontAwesome jika ingin tampil di frontend.</small>
        </div>
        <div class="form-group col-md-6">
            <label class="font-weight-semibold">Gambar / Path</label>
            <input type="text" name="image_path" class="form-control" value="{{ old('image_path', $service->image_path) }}" placeholder="/images/layanan/poli-umum.jpg">
        </div>
    </div>

    <div class="form-group">
        <label class="font-weight-semibold">Deskripsi</label>
        <textarea name="description" class="form-control" rows="4" placeholder="Deskripsi singkat layanan">{{ old('description', $service->description) }}</textarea>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label class="font-weight-semibold">Status Aktif</label>
            <select name="is_active" class="form-control select2" required>
                <option value="1" {{ old('is_active', $service->is_active ?? true) ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ !old('is_active', $service->is_active ?? true) ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>
    </div>

    <div class="text-right">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary px-4">{{ $submitLabel }}</button>
    </div>
</form>
