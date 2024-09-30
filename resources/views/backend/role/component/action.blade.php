<div class="btn-group">
    <a href="{{ route('admin.role.edit', $id) }}" class="btn btn-sm btn-primary me-2" title="Edit">
        <i class="fas fa-edit"></i>
    </a>

    <form action="{{ route('admin.role.destroy', $id) }}" method="POST" style="display: inline;" class="delete-role-form" data-role-id="{{ $id }}">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-sm btn-danger delete-role-btn" title="Delete" data-role-id="{{ $id }}">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>

<script src="/backend/assets/custom/js/ajax/role/role_delete.js"></script>
<script type="text/javascript">
    loadRoleDelete('.delete-role-form')
</script>