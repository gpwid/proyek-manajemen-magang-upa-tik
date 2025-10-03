<?php $__env->startSection('title', 'Penugasan Baru'); ?>
<?php $__env->startSection('penugasan-active', 'active'); ?>
<?php $__env->startSection('title', 'Buat Penugasan Baru'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Buat Penugasan Baru</h1>
            <a href="<?php echo e(route('admin.penugasan.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left fa-sm"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Formulir Penugasan</h6>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('admin.penugasan.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>

                    
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
                                            data-participants="<?php echo e(json_encode($internship->participants->pluck('id', 'nama'))); ?>">
                                            ID: <?php echo e($internship->id); ?> -
                                            <?php echo e($internship->permohonan->institute->nama_instansi); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            
                            <div class="form-group">
                                <label for="participant_id">Peserta <span class="text-danger">*</span></label>
                                <select name="participant_id" id="participant_id" class="form-control" required disabled>
                                    <option value="">-- Pilih Sesi Magang Terlebih Dahulu --</option>
                                </select>
                            </div>

                            
                            <div class="form-group">
                                <label for="title">Judul Tugas <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="<?php echo e(old('title')); ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            
                            <div class="form-group">
                                <label for="task_date">Tanggal Tugas <span class="text-danger">*</span></label>
                                <input type="date" name="task_date" id="task_date" class="form-control"
                                    value="<?php echo e(old('task_date', now()->format('Y-m-d'))); ?>" required>
                            </div>

                            
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

                    
                    <div class="form-group">
                        <label for="description">Deskripsi Tugas <span class="text-danger">*</span></label>
                        <textarea name="description" id="description" rows="5" class="form-control" required><?php echo e(old('description')); ?></textarea>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/admin/penugasan/create.blade.php ENDPATH**/ ?>