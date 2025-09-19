@extends('admin.layoutsadmin.main')

@section('title', 'Penugasan Baru')
@section('penugasan-active', 'active')
@section('title', 'Buat Penugasan Baru')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Buat Penugasan Baru</h1>
            <a href="{{ route('admin.penugasan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left fa-sm"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Penugasan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.penugasan.store') }}" method="POST">
                    @csrf

                    {{-- Menampilkan error validasi jika ada --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            {{-- Dropdown Internship --}}
                            <div class="form-group">
                                <label for="internship_id">Sesi Magang <span class="text-danger">*</span></label>
                                <select name="internship_id" id="internship_id" class="form-control" required>
                                    <option value="">-- Pilih Sesi Magang --</option>
                                    @foreach ($internships as $internship)
                                        <option value="{{ $internship->id }}"
                                            data-participants="{{ json_encode($internship->participants->pluck('id', 'nama')) }}">
                                            ID: {{ $internship->id }} -
                                            {{ $internship->permohonan->institute->nama_instansi }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Dropdown Peserta --}}
                            <div class="form-group">
                                <label for="participant_id">Peserta <span class="text-danger">*</span></label>
                                <select name="participant_id" id="participant_id" class="form-control" required disabled>
                                    <option value="">-- Pilih Sesi Magang Terlebih Dahulu --</option>
                                </select>
                            </div>

                            {{-- Judul Tugas --}}
                            <div class="form-group">
                                <label for="title">Judul Tugas <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{-- Tanggal Tugas --}}
                            <div class="form-group">
                                <label for="task_date">Tanggal Tugas <span class="text-danger">*</span></label>
                                <input type="date" name="task_date" id="task_date" class="form-control"
                                    value="{{ old('task_date', now()->format('Y-m-d')) }}" required>
                            </div>

                            {{-- Status Tugas --}}
                            <div class="form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="Dikerjakan" selected>Dikerjakan</option>
                                    <option value="Revisi">Revisi</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi Tugas --}}
                    <div class="form-group">
                        <label for="description">Deskripsi Tugas <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="5" class="form-control" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save fa-sm"></i> Simpan Tugas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Event listener untuk dropdown internship
            $('#internship_id').on('change', function() {
                // Dapatkan data peserta dari atribut data-participants
                const selectedOption = $(this).find('option:selected');
                const participants = selectedOption.data('participants') || {};

                const participantSelect = $('#participant_id');
                participantSelect.empty(); // Kosongkan dropdown peserta

                if (Object.keys(participants).length > 0) {
                    participantSelect.prop('disabled', false);
                    participantSelect.append('<option value="">-- Pilih Peserta --</option>');

                    // Isi dropdown peserta dengan data yang sesuai
                    $.each(participants, function(nama, id) {
                        participantSelect.append($('<option>', {
                            value: id,
                            text: nama
                        }));
                    });
                } else {
                    participantSelect.prop('disabled', true);
                    participantSelect.append(
                        '<option value="">-- Tidak ada peserta di sesi ini --</option>');
                }
            });
        });
    </script>
@endpush
