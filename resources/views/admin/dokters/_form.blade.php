@php
    $isEdit = $doctor->exists;
    $action = $isEdit ? route('admin.dokter.update', $doctor->id) : route('admin.dokter.store');
@endphp

<form id="doctorForm" method="POST" action="{{ $action }}">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <div class="form-row">
        <div class="form-group col-md-4">
            <label>Kode Dokter</label>
            <input type="text" name="kd_dokter" class="form-control" value="{{ old('kd_dokter', $doctor->kd_dokter) }}" required>
        </div>
        <div class="form-group col-md-8">
            <label>Nama Dokter</label>
            <input type="text" name="nm_dokter" class="form-control" value="{{ old('nm_dokter', $doctor->nm_dokter) }}" required>
        </div>
        <div class="form-group col-md-2">
            <label>JK</label>
            <input type="text" name="jk" class="form-control" value="{{ old('jk', $doctor->jk) }}" maxlength="1">
        </div>
        <div class="form-group col-md-5">
            <label>Tempat Lahir</label>
            <input type="text" name="tmp_lahir" class="form-control" value="{{ old('tmp_lahir', $doctor->tmp_lahir) }}">
        </div>
        <div class="form-group col-md-5">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', optional($doctor->tgl_lahir)->format('Y-m-d')) }}">
        </div>
        <div class="form-group col-md-3">
            <label>Gol. Darah</label>
            <input type="text" name="gol_drh" class="form-control" value="{{ old('gol_drh', $doctor->gol_drh) }}" maxlength="3">
        </div>
        <div class="form-group col-md-5">
            <label>Agama</label>
            <input type="text" name="agama" class="form-control" value="{{ old('agama', $doctor->agama) }}">
        </div>
        <div class="form-group col-md-4">
            <label>Status Nikah</label>
            <input type="text" name="stts_nikah" class="form-control" value="{{ old('stts_nikah', $doctor->stts_nikah) }}">
        </div>
        <div class="form-group col-md-12">
            <label>Alamat</label>
            <textarea name="almt_tgl" class="form-control" rows="3">{{ old('almt_tgl', $doctor->almt_tgl) }}</textarea>
        </div>
        <div class="form-group col-md-4">
            <label>No. Telp</label>
            <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $doctor->no_telp) }}">
        </div>
        <div class="form-group col-md-4">
            <label>Kode Spesialis</label>
            <input type="text" name="kd_sps" class="form-control" value="{{ old('kd_sps', $doctor->kd_sps) }}">
        </div>
        <div class="form-group col-md-4">
            <label>Alumni</label>
            <input type="text" name="alumni" class="form-control" value="{{ old('alumni', $doctor->alumni) }}">
        </div>
        <div class="form-group col-md-6">
            <label>No. Izin Praktek</label>
            <input type="text" name="no_ijn_praktek" class="form-control" value="{{ old('no_ijn_praktek', $doctor->no_ijn_praktek) }}">
        </div>
        <div class="form-group col-md-3 d-flex align-items-end">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="doctorStatus" name="status" value="1" {{ old('status', $doctor->status ?? true) ? 'checked' : '' }}>
                <label class="custom-control-label" for="doctorStatus">Aktif</label>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn btn-light mr-2" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">
            {{ $isEdit ? 'Update Dokter' : 'Simpan Dokter' }}
        </button>
    </div>
</form>

