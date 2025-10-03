<?php $__env->startSection('title', 'Edit Penugasan'); ?>
<?php $__env->startSection('penugasan-active', 'active'); ?>
<?php $__env->startSection('title', 'Edit Penugasan'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Tugas: <?php echo e($task->title); ?></h1>
            <a href="<?php echo e(route('admin.penugasan.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left fa-sm"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Penugasan</h6>
            </div>
            <div class="card-body">
                
                <form action="<?php echo e(route('admin.penugasan.update', $task->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="internship_id">Sesi Magang <span class="text-danger">*</span></label>
                                <select name="internship_id" id="internship_id" class="form-control" required>
                                    <option value="">-- Pilih Sesi Magang --</option>
                                    <?php $__currentLoopData = $internships; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $internship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($internship->id); ?>"
                                            data-participants="<?php echo e(json_encode($internship->participants->pluck('id', 'nama'))); ?>"
                                            
                                            <?php echo e(old('internship_id', $task->internship_id) == $internship->id ? 'selected' : ''); ?>>
                                            ID: <?php echo e($internship->id); ?> -
                                            <?php echo e($internship->permohonan->institute->nama_instansi); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            
                            <div class="form-group">
                                <label for="participant_id">Peserta <span class="text-danger">*</span></label>
                                <select name="participant_id" id="participant_id" class="form-control" required>
                                    
                                    <option value="">-- Pilih Sesi Magang Terlebih Dahulu --</option>
                                </select>
                            </div>

                            
                            <div class="form-group">
                                <label for="title">Judul Tugas <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="<?php echo e(old('title', $task->title)); ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="task_date">Tanggal Tugas <span class="text-danger">*</span></label>
                                <input type="date" name="task_date" id="task_date" class="form-control"
                                    value="<?php echo e(old('task_date', $task->task_date->format('Y-m-d'))); ?>" required>
                            </div>

                            
                            <div class="form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="Dikerjakan"
                                        <?php echo e(old('status', $task->status) == 'Dikerjakan' ? 'selected' : ''); ?>>Dikerjakan
                                    </option>
                                    <option value="Revisi"
                                        <?php echo e(old('status', $task->status) == 'Revisi' ? 'selected' : ''); ?>>Revisi</option>
                                    <option value="Selesai"
                                        <?php echo e(old('status', $task->status) == 'Selesai' ? 'selected' : ''); ?>>Selesai</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <label for="description">Deskripsi Tugas <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="5" class="form-control" required><?php echo e(old('description', $task->description)); ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save fa-sm"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function() {
            // Fungsi untuk mengisi dropdown peserta berdasarkan sesi magang yang dipilih
            function populateParticipants(selectedInternshipId, selectedParticipantId) {
                const selectedOption = $('#internship_id').find('option:selected');
                const participants = selectedOption.data('participants') || {};
                const participantSelect = $('#participant_id');

                participantSelect.empty(); // Kosongkan dulu

                if (Object.keys(participants).length > 0) {
                    participantSelect.prop('disabled', false);
                    participantSelect.append('<option value="">-- Pilih Peserta --</option>');

                    // Isi dropdown dengan peserta yang sesuai
                    $.each(participants, function(nama, id) {
                        const option = $('<option>', {
                            value: id,
                            text: nama
                        });
                        // Jika ID peserta cocok dengan yang sedang diedit, pilih opsi tersebut
                        if (id == selectedParticipantId) {
                            option.prop('selected', true);
                        }
                        participantSelect.append(option);
                    });
                } else {
                    participantSelect.prop('disabled', true);
                    participantSelect.append('<option value="">-- Tidak ada peserta di sesi ini --</option>');
                }
            }

            // --- Logika Utama ---
            // 1. Dapatkan ID sesi dan peserta awal dari data tugas yang diedit
            const initialInternshipId = $('#internship_id').val();
            const initialParticipantId = "<?php echo e($task->participant_id); ?>";

            // 2. Jika ada sesi magang yang sudah terpilih saat halaman dimuat, langsung isi pesertanya
            if (initialInternshipId) {
                populateParticipants(initialInternshipId, initialParticipantId);
            }

            // 3. Buat event listener. Jika dropdown sesi magang berubah, isi ulang pesertanya
            $('#internship_id').on('change', function() {
                // Saat berubah, kita tidak perlu memilih peserta secara otomatis lagi
                populateParticipants($(this).val(), null);
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/admin/penugasan/edit.blade.php ENDPATH**/ ?>