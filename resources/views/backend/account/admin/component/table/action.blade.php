<div class="btn-group">
    <a href="{{ route('admin.admin.edit', $id) }}" class="btn btn-sm btn-primary me-2" title="Edit">
        <i class="fas fa-edit"></i>
    </a>

    <form action="{{ route('admin.admin.destroy', $id) }}" method="POST" style="display: inline;" class="delete-admin-form" data-admin-id="{{ $id }}">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-sm btn-danger delete-btn" title="Delete" data-admin-id="{{ $id }}">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>

<script src="/backend/assets/custom/js/ajax/loadDeleteAjax.js"></script>
<script type="text/javascript">
    loadDeleteAjax('.delete-admin-form')
</script>
