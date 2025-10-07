<?php $__env->startSection('pembimbing-active', 'active'); ?>
<?php $__env->startSection('title', 'Pembimbing'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h3 mb-3 text-gray-800">Pembimbing</h1>
    </div>

    <div class="card">
        <div class="card-body">
            
            <div class="row align-items-end g-3 mb-3">

                
                <div class="col-md-9 pe-lg-3">
                    <label class="form-label">Pencarian</label>
                    <div class="search-wrapper">
                        <span class="search-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <circle cx="11" cy="11" r="7" stroke="#94A3B8" stroke-width="2" />
                                <line x1="16.65" y1="16.65" x2="21" y2="21" stroke="#94A3B8" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </span>
                        <input type="text" id="searchbox" class="form-control search-control" placeholder="Cari...">
                        <button type="button" id="clearSearch" class="clear-btn" aria-label="Bersihkan">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none">
                                <path d="M18 6L6 18M6 6l12 12" stroke="#9CA3AF" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </button>
                    </div>
                </div>

                
                <div class="col-md-3 text-lg-end">
                    <label class="form-label d-none d-lg-block">&nbsp;</label>
                    <a class="btn btn-primary px-3 shadow-sm w-100 w-lg-auto" href="<?php echo e(route('admin.pembimbing.create')); ?>">
                        <i class="fas fa-plus me-1"></i> Tambah Pembimbing
                    </a>
                </div>
            </div>

            
            <div class="d-flex flex-wrap gap-3 mb-2">
                <button id="btnExportExcel" type="button" class="btn btn-success">
                    <i class="fas fa-file-excel me-1"></i> Excel
                </button>
                <button id="btnExportPdf" type="button" class="btn btn-danger">
                    <i class="fas fa-file-pdf me-1"></i> PDF
                </button>
            </div>

            <!-- Tabel -->
            <table id="pembimbing-table" class="display table table-striped table-hover align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>


<style>
    .card .card-body { padding: 1.25rem 1.25rem 1rem; }
    #pembimbing-table_wrapper .row { align-items: center; }

    /* Searchbar */
    .search-wrapper { position: relative; }
    .search-icon {
        position: absolute; left: 12px; top: 50%; transform: translateY(-50%);
        display: inline-flex; align-items: center; justify-content: center; width: 20px; height: 20px; pointer-events: none;
    }
    .clear-btn {
        position: absolute; right: 10px; top: 50%; transform: translateY(-50%);
        border: 0; background: transparent; display: none; padding: 0; line-height: 0;
    }
    .search-control {
        height: 42px !important; border-radius: 12px !important; border: 1px solid #e5e7eb !important;
        padding-left: 2.6rem !important; padding-right: 2.4rem !important; box-shadow: 0 1px 2px rgba(16,24,40,.04) !important;
    }
    .search-control::placeholder { color: #9ca3af; }
    .search-control:focus { border-color: #c7d2fe !important; box-shadow: 0 0 0 .2rem rgba(99,102,241,.2) !important; }

    /* DataTables length */
    .dataTables_length { display: flex; align-items: center; gap: .5rem; }
    .dataTables_length label { font-weight: 600; color: #64748b; margin-bottom: 0; }
    .dataTables_length:after { content: 'data'; margin-left: .35rem; color: #64748b; font-weight: 600; }
    @media (max-width:768px){ .dataTables_length:after { display:none; } }

    /* Table polish */
    #pembimbing-table { border-radius: 14px; overflow: hidden; }
    #pembimbing-table thead th { background: #f8fafc; font-weight: 700; border-bottom: 1px solid #e9ecef; }
    #pembimbing-table tbody td { vertical-align: middle; }
    #pembimbing-table.table-hover tbody tr:hover { background: #f6f9ff; }
    .text-nowrap { white-space: nowrap; }

    /* Actions */
    .btn-icon { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; }
    .btn-icon + .btn-icon { margin-left: .35rem; }

    /* Info & Pagination */
    .dataTables_info { color: #6b7280; }
    .dataTables_paginate { text-align: right; }
    .dataTables_paginate .paginate_button {
        border: 1px solid #e5e7eb !important; border-radius: 9999px !important;
        padding: .48rem .9rem !important; margin: 0 .2rem !important;
        background: #fff !important; color: #334155 !important; font-weight: 600 !important;
    }
    .dataTables_paginate .paginate_button.previous::before { content: '‹'; margin-right: .35rem; font-weight: 800; }
    .dataTables_paginate .paginate_button.next::after { content: '›'; margin-left: .35rem; font-weight: 800; }
    .dataTables_paginate .paginate_button.current,
    .dataTables_paginate .paginate_button:hover {
        background: #eef2ff !important; border-color: #c7d2fe !important; color: #3730a3 !important;
        box-shadow: 0 1px 2px rgba(16, 24, 40, .08);
    }
    .dataTables_paginate .paginate_button.disabled { opacity: .55; cursor: default !important; }
</style>


<?php $__env->startSection('scripts'); ?>
<?php if(session('sukses')): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: "<?php echo e(session('sukses')); ?>",
        showConfirmButton: false,
        timer: 1500
    });
</script>
<?php endif; ?>

<script>
$(function () {
    if ($.fn.DataTable.isDataTable('#pembimbing-table')) {
        $('#pembimbing-table').DataTable().destroy();
    }

    const table = $('#pembimbing-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo route("admin.pembimbing.data"); ?>',
            data: d => {
                d.searchbox = $('#searchbox').val();
            }
        },
        columns: [
            { // No.
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            { // Nama
                data: 'nama',
                name: 'nama'
            },
            { // Email
                data: 'email',
                name: 'email'
            },
            { // NIP
                data: 'nip',
                name: 'nip',
                className: 'text-nowrap'
            },
            { // Aksi
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false,
                className: 'text-nowrap'
            }
        ],

        // Default order: kolom Nama ASC (index 1)
        order: [[1, 'asc']],

        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'Semua']],

        dom:
          "<'row align-items-center mb-2'<'col-md-6'l><'col-md-6'>>" +
          "<'row'<'col-12'tr>>" +
          "<'row mt-2'<'col-md-4'i><'col-md-8'p>>",

        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
            lengthMenu: 'Tampilkan _MENU_',
            paginate: { previous: 'Sebelumnya', next: 'Berikutnya' }
        },

        responsive: true,
        autoWidth: false,

        initComplete: function () {
            // Length menu → biarkan native (stabil), atau aktifkan Select2 kalau mau
            // Contoh jika ingin Select2:
            // $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity, width: 'style' });
        }
    });

    // Search + tombol clear
    $('#searchbox').on('keyup', () => table.ajax.reload());
    $('#searchbox').on('input', function () {
        $('#clearSearch').toggle(this.value.length > 0);
    });
    $('#clearSearch').on('click', function () {
        $('#searchbox').val('');
        $(this).hide();
        table.ajax.reload();
    }).hide();

    // Tooltip untuk tombol aksi (jika pakai Bootstrap)
    if (typeof bootstrap !== 'undefined') {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
    }

    // ===== Export buttons =====
    function buildQuery() {
        return $.param({
            searchbox: $('#searchbox').val() || ''
        });
    }

    $('#btnExportExcel').on('click', function () {
        const qs = buildQuery();
        window.location = "<?php echo e(route('admin.pembimbing.export.excel')); ?>" + (qs ? ('?' + qs) : '');
    });

    $('#btnExportPdf').on('click', function () {
        const qs = buildQuery();
        window.location = "<?php echo e(route('admin.pembimbing.export.pdf')); ?>" + (qs ? ('?' + qs) : '');
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layoutsadmin.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\proyek-manajemen-magang-upa-tik\resources\views/admin/pembimbing/index.blade.php ENDPATH**/ ?>