<div class="flex gap-2" role="group">

    <!-- Tombol Edit -->
    <a href="{{ route('admin.peserta.edit', $p->id) }}" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
        data-bs-placement="top" title="Edit">
        <i class="fas fa-edit"></i> Edit
    </a>

    <!-- Tombol Detail -->
    <a href="{{ route('admin.peserta.show', $p->id) }}" class="btn btn-sm btn-success" data-bs-toggle="tooltip"
        data-bs-placement="top" title="Detail">
        <i class="fas fa-eye"></i> Detail
    </a>
</div>
