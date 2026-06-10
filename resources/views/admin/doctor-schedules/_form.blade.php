@php
    $isEdit = $schedule->exists;
    $action = $isEdit ? route('admin.jadwal-dokter.update', $schedule->id) : route('admin.jadwal-dokter.store');
@endphp

<form id="scheduleForm" method="POST" action="{{ $action }}">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="form-row">
        <div class="form-group col-md-12">
            <label>Dokter</label>
            <select name="doctor_id" class="form-control select2" required>
                <option value="">Pilih dokter</option>
                @foreach ($dokters as $dokter)
                    <option value="{{ $dokter->id }}" @selected(old('doctor_id', $schedule->doctor_id) == $dokter->id)>
                        {{ $dokter->kd_dokter }} - {{ $dokter->nm_dokter }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>Hari</label>
            <select name="day_name" class="form-control" required>
                @foreach (['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $day)
                    <option value="{{ $day }}" @selected(old('day_name', $schedule->day_name) === $day)>{{ $day }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label>Jam Mulai</label>
            <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $schedule->start_time) }}">
        </div>
        <div class="form-group col-md-4">
            <label>Jam Selesai</label>
            <input type="time" name="end_time" class="form-control" value="{{ old('end_time', $schedule->end_time) }}">
        </div>
        <div class="form-group col-md-12">
            <label>Layanan / Poli</label>
            <select name="service_id" class="form-control select2" required>
                <option value="">Pilih layanan / poli</option>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}" @selected(old('service_id', $schedule->service_id) == $service->id)>
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12">
            <label>Catatan</label>
            <textarea name="notes" class="form-control" rows="3">{{ old('notes', $schedule->notes) }}</textarea>
        </div>
        <div class="form-group col-md-3 d-flex align-items-end">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="scheduleStatus" name="is_active" value="1" {{ old('is_active', $schedule->is_active ?? true) ? 'checked' : '' }}>
                <label class="custom-control-label" for="scheduleStatus">Aktif</label>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn btn-light mr-2" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">
            {{ $isEdit ? 'Update Jadwal' : 'Simpan Jadwal' }}
        </button>
    </div>
</form>
