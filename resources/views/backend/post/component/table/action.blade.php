<div class="btn-group">
    <a href="{{ route('admin.post.edit', $id) }}" class="btn btn-sm btn-primary me-2" title="Edit">
        <i class="fas fa-edit"></i>
    </a>

    <form action="{{ route('admin.post.destroy', $id) }}" method="POST" style="display: inline;" class="delete-post-form" data-post-id="{{ $id }}">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-sm btn-danger delete-btn" title="Delete" data-post-id="{{ $id }}">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</div>

<script src="/backend/assets/custom/js/ajax/loadDeleteAjax.js"></script>
<script type="text/javascript">
    loadDeleteAjax('.delete-post-form')
</script>
