<div class="btn-group">
    <a href="{{ route('admin.user.edit', $id) }}" class="btn btn-sm btn-primary me-2" title="Edit">
        <i class="fas fa-edit"></i>
    </a>

    <form action="{{ route('admin.user.destroy', $id) }}" method="POST" style="display: inline;" class="delete-user-form" data-user-id="{{ $id }}">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-sm btn-danger delete-btn" title="Delete" data-user-id="{{ $id }}">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>

<script src="/backend/assets/custom/js/ajax/loadDeleteAjax.js"></script>
<script type="text/javascript">
    loadDeleteAjax('.delete-user-form')
</script>
