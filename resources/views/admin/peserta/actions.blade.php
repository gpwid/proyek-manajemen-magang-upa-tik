<div class="btn-group" role="group">
    <!-- Tombol Detail -->
    <a href="{{ route('admin.peserta.show', $p->id) }}"
       class="btn btn-sm btn-success"
       data-bs-toggle="tooltip"
       data-bs-placement="top"
       title="Detail">
        <i class="fas fa-eye"></i>
    </a>

    <!-- Tombol Edit -->
    <a href="{{ route('admin.peserta.edit', $p->id) }}"
       class="btn btn-sm btn-primary"
       data-bs-toggle="tooltip"
       data-bs-placement="top"
       title="Edit">
        <i class="fas fa-edit"></i>
    </a>
</div>
