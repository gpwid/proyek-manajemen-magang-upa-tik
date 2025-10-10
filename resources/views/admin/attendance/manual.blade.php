@extends('admin.layoutsadmin.main')
@section('title', 'Absensi Manual (Izin/Sakit)')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <h1 class="h3 mb-0 text-gray-800">Absensi Manual</h1>
    </div>

    <div class="card shadow col-12 col-lg-8 p-4">
        <form action="{{ route('admin.attendance.manual.store') }}" method="POST">
            @csrf

            {{-- Peserta --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Peserta <span class="text-danger">*</span></label>
                <select name="participant_id" class="form-select @error('participant_id') is-invalid @enderror" required>
                    <option value="" disabled {{ empty($selectedParticipantId) ? 'selected' : '' }}>-- Pilih Peserta (approved) --</option>
                    @foreach($participants as $p)
                        <option value="{{ $p->id }}" {{ (old('participant_id', $selectedParticipantId) == $p->id) ? 'selected' : '' }}>
                            {{ $p->nama }} ({{ $p->nisnim }})
                        </option>
                    @endforeach
                </select>
                @error('participant_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Tanggal --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal <span class="text-danger">*</span></label>
                <input type="date" name="date" value="{{ old('date', now()->toDateString()) }}"
                       class="form-control @error('date') is-invalid @enderror" required>
                @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    <option value="Izin"  {{ old('status') === 'Izin' ? 'selected' : '' }}>Izin</option>
                    <option value="Sakit" {{ old('status') === 'Sakit' ? 'selected' : '' }}>Sakit</option>
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- Keterangan --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Keterangan <span class="text-danger">*</span></label>
                <textarea name="note" rows="3" class="form-control @error('note') is-invalid @enderror" placeholder="Masukkan keterangan singkat (contoh: surat dokter, alasan izin, dsb.)" required>{{ old('note') }}</textarea>
                @error('note') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Absensi</button>
            </div>
        </form>
    </div>
</div>
@endsection
