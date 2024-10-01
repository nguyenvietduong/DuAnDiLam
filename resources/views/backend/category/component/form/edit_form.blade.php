<form id="myForm" class="p-4 pt-3" action="{{ route('admin.category.update', $category->id) }}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
        <div class="row">
            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                <label for="name" class="form-label">Category Name </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name ?? '') }}" onkeyup="generateSlug('name', 'slug')" placeholder="Enter category name">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end col-->

            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                <label for="slug" class="form-label">Slug </label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $category->slug ?? '') }}" id="slug" placeholder="Enter slug">
                @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end col-->

            <div class="col-lg-4 col-12 mb-2 mb-lg-1">
                <label for="parent" class="form-label">Parent </label>
                <select name="parent_id" class="form-control setupSelect2 @error('slug') is-invalid @enderror" id="parent">
                    <option value="">No Parent</option>
                    @foreach ($categories as $category)
                    @include(
                    'backend.category.partials.category_option',
                    ['category' => $category]
                    )
                    @endforeach
                </select>

                @error('parent_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--end col-->

        </div>
        <!--end row-->
    </div>
    <!--end form-group-->

    <div class="d-flex justify-content-end mt-3">
        <button type="button" class="btn btn-primary me-2" onclick="executeExample('handleDismiss', 'myForm')">{{ __('messages.system.button.update') }}</button>
        <a href="{{ route(__('messages.' . $object . '.index.route')) }}"> <button type="button" class="btn btn-danger">{{ __('messages.system.button.cancel') }}</button></a>
    </div>
</form>
